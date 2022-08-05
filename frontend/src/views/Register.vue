<template>
    <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center vh-100 bg-primary">
            <div class="col-xxl-2 col-md-3">
                <h1 class="text-center text-white py-3">Fazer Cadastro</h1>
                <div v-show="message" class="alert alert-success text-center" role="alert">
                    {{ message }}
                </div>
                <form @submit.prevent="register">
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="name" class="form-control" id="name" placeholder=" " v-model="name" autofocus />
                            <span class="text-white">{{ errors.name ? errors.name[0] : '' }}</span>
                            <label for="email" class="col-form-label">Nome</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" placeholder=" " v-model="email" />
                            <span class="text-white">{{ errors.email ? errors.email[0] : '' }}</span>
                            <label for="email" class="col-form-label">E-mail</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password" placeholder=" " v-model="password" />
                            <span class="text-white">{{ errors.password ? errors.password[0] : '' }}</span>
                            <label for="password" class="col-form-label">Senha</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password_confirmation" placeholder=" " v-model="password_confirmation" />
                            <span class="text-white">{{ errors.password_confirmation ? errors.password_confirmation[0] : '' }}</span>
                            <label for="password" class="col-form-label">Confirmar Senha</label>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-dark" type="submit">Cadastrar</button>
                            <router-link class="btn btn-secondary" to="/login">Login</router-link>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { api } from '../services/ApiService';

export default {
    name: 'Register',
    data: function () {
        return {
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            message: '',
            errors: [],
        };
    },
    created: function () {
        document.title = 'Sistema LaraVue :: Register';
    },
    methods: {
        register: async function () {
            try {
                let response = await api.register(this.name, this.email, this.password, this.password_confirmation);

                if (response.data) {
                    this.message = response.data.message;
                    this.name = '';
                    this.email = '';
                    this.password = '';
                    this.password_confirmation = '';
                    this.errors = [];

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
    },
};
</script>

<style scoped></style>
