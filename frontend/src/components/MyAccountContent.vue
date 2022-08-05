<template>
    <div class="col py-3">
        <h1 class="text-white">Minha Conta</h1>
        <div v-show="message" class="alert alert-success text-center" role="alert">
            {{ message }}
        </div>
        <form @submit.prevent="updateUser">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="name" class="form-control" id="name" placeholder=" " v-model="name" />
                            <span class="text-white">{{ errors.name ? errors.name[0] : '' }}</span>
                            <label for="email" class="col-form-label">Nome</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" placeholder=" " v-model="email" />
                            <span class="text-white">{{ errors.email ? errors.email[0] : '' }}</span>
                            <label for="email" class="col-form-label">E-mail</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password" placeholder=" " v-model="password" />
                            <span class="text-white">{{ errors.password ? errors.password[0] : '' }}</span>
                            <label for="password" class="col-form-label">Senha</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password_confirmation" placeholder=" " v-model="password_confirmation" />
                            <span class="text-white">{{ errors.password_confirmation ? errors.password_confirmation[0] : '' }}</span>
                            <label for="password" class="col-form-label">Confirmar Senha</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="updated_at" placeholder=" " :value="formatDate(updated_at)" disabled />
                            <label for="updated_at" class="col-form-label">Data Atualização</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="created_at" placeholder=" " :value="formatDate(created_at)" disabled />
                            <label for="created_at" class="col-form-label">Data Criação</label>
                        </div>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-dark" type="submit">Atualizar</button>
                </div>
            </div>
        </form>
        <footer class="mt-5">
            <p class="text-center text-white">
                Sistema Desenvolvido por: <a href="https://euygor.com" target="_blank"><strong class="text-white">Ygor Oliveira</strong></a>
            </p>
        </footer>
    </div>
</template>

<script>
import { api } from '../services/ApiService';

export default {
    name: 'MyAccountContent',
    data: function () {
        return {
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            updated_at: '',
            created_at: '',
            message: '',
            errors: [],
        };
    },
    created: function () {
        this.getUser();
    },
    methods: {
        getUser: async function () {
            try {
                let response = await api.auth(localStorage.getItem('token'));
                this.name = response.data.user.name;
                this.email = response.data.user.email;
                this.updated_at = response.data.user.updated_at;
                this.created_at = response.data.user.created_at;
            } catch (error) {
                return error;
            }
        },
        updateUser: async function () {
            try {
                let response = await api.updateUser(this.name, this.email, this.password, this.password_confirmation);

                if (response.data) {
                    this.message = response.data.message;
                    this.password = '';
                    this.password_confirmation = '';
                    this.errors = [];

                    this.getUser();

                    setTimeout(() => {
                        this.message = '';
                    }, 15000);
                }

                if (response.response.data) {
                    if (response.response.data.errors) {
                        this.errors = response.response.data.errors;
                    }
                }
            } catch (error) {
                return error;
            }
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
};
</script>
