<template>
    <div class="col py-3">
        <h1 class="text-white">Produtos</h1>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success my-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Novo Produto</button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form @submit.prevent="createProduct">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cadastrar Produto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div v-show="messageCreate" class="alert alert-success text-center" role="alert">
                                {{ messageCreate }}
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="name" placeholder=" " v-model="name" />
                                <span class="text-dark">{{ errorsCreate.name ? errorsCreate.name[0] : '' }}</span>
                                <label for="name" class="text-secondary text-start">Nome</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" step="0.01" class="form-control" id="price" placeholder=" " v-model="price" />
                                <span class="text-dark">{{ errorsCreate.price ? errorsCreate.price[0] : '' }}</span>
                                <label for="price" class="text-secondary text-start">Preço</label>
                            </div>
                            <div class="mb-3 text-center">
                                <label for="description" class="text-secondary pb-3">Descrição</label>
                                <p v-if="errorsCreate.description" class="text-dark">{{ errorsCreate.description ? errorsCreate.description[0] : '' }}</p>
                                <textarea class="form-control" id="description" rows="3" cols="10" v-model="description"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" @click="getProducts" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Cadastrar Produto</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <form @submit.prevent="" @change="searchProduct">
            <div class="form-floating mb-3" style="width: 300px">
                <input type="text" class="form-control" id="search" placeholder=" " v-model="search" />
                <label for="search" class="text-secondary">Buscar produtos por página...</label>
            </div>
        </form>
        <div v-show="message" class="alert alert-danger text-center" role="alert">
            {{ message }}
        </div>
        <div v-if="products == ''" class="alert alert-warning text-center" role="alert">Nenhum produto cadastrado.</div>
        <div v-else class="table-responsive text-center">
            <div class="d-flex justify-content-md-end justify-content-center" v-if="pagination.last_page > 1">
                <Pagination :source="pagination" @navigate="navigate" />
            </div>
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th style="width: 200px" scope="col">ID</th>
                        <th style="width: 400px" scope="col">Produto</th>
                        <th style="width: 300px" scope="col">Preço</th>
                        <th style="width: 240px" scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(product, index) in products" :key="index">
                        <td class="text-white">{{ product.id }}</td>
                        <td class="text-white">{{ formatText(product.name) }}</td>
                        <td class="text-white">{{ formatPrice(product.price) }}</td>
                        <td>
                            <!-- Button trigger modal view product -->
                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" :data-bs-target="'#exampleModalv' + product.id">Visualizar</button>
                            <!-- Modal view product -->
                            <div class="modal fade" :id="'exampleModalv' + product.id" tabindex="-1" :aria-labelledby="'exampleModalLabelv' + product.id" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form>
                                            <div class="modal-header">
                                                <h5 class="modal-title" :id="'exampleModalLabelv' + product.id">Visualizar Produto: {{ product.id }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="name" placeholder=" " v-model="product.name" disabled />
                                                    <label for="name" class="text-secondary text-start">Nome</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="price" placeholder=" " v-model="product.price" disabled />
                                                    <label for="price" class="text-secondary text-start">Preço</label>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description" class="text-secondary pb-3">Descrição</label>
                                                    <textarea class="form-control" id="description" rows="3" cols="10" v-model="product.description" disabled></textarea>
                                                </div>
                                                <hr />
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control" id="updated_at" placeholder=" " :value="formatDate(product.updated_at)" disabled />
                                                            <label for="updated_at" class="col-form-label">Data Atualização</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control" id="created_at" placeholder=" " :value="formatDate(product.created_at)" disabled />
                                                            <label for="created_at" class="col-form-label">Data Criação</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" :data-bs-target="'#exampleModalp' + product.id">Editar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Button trigger modal edit product -->
                            <button type="button" class="btn btn-sm btn-success mx-2" data-bs-toggle="modal" :data-bs-target="'#exampleModalp' + product.id">Editar</button>
                            <!-- Modal edit product -->
                            <div class="modal fade" :id="'exampleModalp' + product.id" tabindex="-1" :aria-labelledby="'#exampleModalp' + product.id" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form @submit.prevent="updateProduct(product.id)">
                                            <div class="modal-header">
                                                <h5 class="modal-title" :id="'exampleModalLabelp' + product.id">Editar Produto: {{ product.id }}</h5>
                                                <button type="button" @click="navigate(pagination.current_page)" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div v-show="messageUpdate" class="alert alert-success text-center" role="alert">
                                                    {{ messageUpdate }}
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="name" placeholder=" " @change="name = $event.target.value" v-model="product.name" />
                                                    <span class="text-dark">{{ errorsUpdate.name ? errorsUpdate.name[0] : '' }}</span>
                                                    <label for="name" class="text-secondary text-start">Nome</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="number" step="0.01" class="form-control" id="price" placeholder=" " @change="price = $event.target.value" v-model="product.price" />
                                                    <span class="text-dark">{{ errorsUpdate.price ? errorsUpdate.price[0] : '' }}</span>
                                                    <label for="price" class="text-secondary text-start">Preço</label>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description" class="text-secondary pb-3">Descrição</label>
                                                    <p v-if="errorsUpdate.description" class="text-dark">{{ errorsUpdate.description ? errorsUpdate.description[0] : '' }}</p>
                                                    <textarea class="form-control" id="description" rows="3" cols="10" @change="description = $event.target.value" v-model="product.description"></textarea>
                                                </div>
                                                <hr />
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control" id="updated_at" placeholder=" " :value="formatDate(product.updated_at)" disabled />
                                                            <label for="updated_at" class="col-form-label">Data Atualização</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control" id="created_at" placeholder=" " :value="formatDate(product.created_at)" disabled />
                                                            <label for="created_at" class="col-form-label">Data Criação</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" @click="navigate(pagination.current_page)" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-success">Atualizar Produto</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <a @click.prevent="deleteProduct(product.id)" class="btn btn-sm btn-danger">Excluir</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="d-flex justify-content-center" v-if="pagination.last_page > 1">
                <Pagination :source="pagination" @navigate="navigate" />
            </div>
        </div>
        <footer class="mt-5">
            <p class="text-center text-white">
                Sistema Desenvolvido por: <a href="https://euygor.com" target="_blank"><strong class="text-white">Ygor Oliveira</strong></a>
            </p>
        </footer>
    </div>
</template>

<script>
import Pagination from './Pagination.vue';
import { api } from '../services/ApiService';

export default {
    name: 'HomeContent',
    components: {
        Pagination,
    },
    data: function () {
        return {
            name: '',
            price: '',
            description: '',
            products: [],
            message: '',
            messageUpdate: '',
            messageCreate: '',
            errorsUpdate: [],
            errorsCreate: [],
            search: '',
            pagination: {},
        };
    },
    created: function () {
        this.getUser();
        this.getProducts();
    },
    methods: {
        getUser: async function () {
            try {
                await api.auth(localStorage.getItem('token'));
            } catch (error) {
                return error;
            }
        },
        getProducts: async function (page) {
            try {
                let response = await api.getProducts(page);

                this.products = response.data.products.data;

                this.pagination = response.data.products;
            } catch (error) {
                return error;
            }
        },
        createProduct: async function () {
            try {
                let response = await api.createProduct(this.name, this.description, this.price);

                if (response.data) {
                    this.messageCreate = response.data.message;
                    this.name = '';
                    this.description = '';
                    this.price = '';
                    this.errorsCreate = [];

                    this.getProducts();

                    setTimeout(() => {
                        this.messageCreate = '';
                    }, 15000);
                }

                if (response.response.data) {
                    if (response.response.data.errors) {
                        this.errorsCreate = response.response.data.errors;
                    }
                }
            } catch (error) {
                return error;
            }
        },
        updateProduct: async function (id) {
            try {
                let response = await api.updateProduct(id, this.name, this.description, this.price);

                this.navigate(this.pagination.current_page);

                if (response.data) {
                    this.messageUpdate = response.data.message;
                    this.errorsUpdate = [];

                    setTimeout(() => {
                        this.messageUpdate = '';
                    }, 15000);
                }

                if (response.response.data) {
                    if (response.response.data.errors) {
                        this.errorsUpdate = response.response.data.errors;
                        this.name = '';
                        this.description = '';
                        this.price = '';
                    }
                }
            } catch (error) {
                return error;
            }
        },
        deleteProduct: async function (id) {
            try {
                if (!confirm('Tem certeza que deseja excluir esse Produto?')) {
                    return;
                }

                let response = await api.deleteProduct(id);

                if (response.data) {
                    this.message = response.data.message;
                    this.getProducts();
                    setTimeout(() => {
                        this.message = '';
                    }, 15000);
                }

                if (response.response.data) {
                    this.message = response.response.data.error;
                    setTimeout(() => {
                        this.message = '';
                    }, 15000);
                }
            } catch (error) {
                return error;
            }
        },
        searchProduct: function () {
            if (this.search == '') {
                this.getProducts();
            } else {
                let products = this.products.filter((product) => {
                    return product.id.toString().includes(this.search) || product.name.toLowerCase().includes(this.search.toLowerCase());
                });

                if (products.length == 0) {
                    this.getProducts();
                } else {
                    this.products = products;
                }
            }
        },
        navigate: function (page) {
            this.getProducts(page);
            this.name = '';
            this.description = '';
            this.price = '';
        },
        formatText: function (text) {
            if (text.length > 20) {
                return text.substring(0, 20) + '...';
            } else {
                return text;
            }
        },
        formatPrice: function (price) {
            return price.toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL',
            });
        },
        formatDate: function (date) {
            let d = new Date(date);
            let day = d.getDate();
            let month = d.getMonth() + 1;
            let year = d.getFullYear();
            let hour = d.getHours();
            let minute = d.getMinutes();
            let second = d.getSeconds();

            if (day < 10) {
                day = '0' + day;
            }
            if (month < 10) {
                month = '0' + month;
            }
            if (hour < 10) {
                hour = '0' + hour;
            }
            if (minute < 10) {
                minute = '0' + minute;
            }
            if (second < 10) {
                second = '0' + second;
            }

            return `${day}/${month}/${year} ${hour}:${minute}:${second}`;
        },
    },
    watch: {
        search: function (value) {
            this.searchProduct(value);
        },
    },
};
</script>
