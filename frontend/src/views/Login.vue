<template>
    <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center vh-100 bg-primary">
            <div class="col-xxl-2 col-md-3">
                <h1 class="text-center text-white py-3">Fazer Login</h1>
                <div v-show="message" class="alert alert-danger text-center" role="alert">
                    {{ message }}
                </div>
                <form @submit.prevent="login">
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" placeholder=" " v-model="email" />
                            <span class="text-white">{{ errors.email ? errors.email[0] : '' }}</span>
                            <label for="email" class="col-form-label">E-mail</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input :type="type" class="form-control" id="password" placeholder=" " v-model="password" />
                            <i v-if="show" @click="showPassword" role="button" class="fs-4 bi-eye-slash-fill position-absolute top-50 end-0 translate-middle" :class="{ 'pb-4': errors.password }"></i>
                            <i v-else role="button" @click="showPassword" class="fs-4 bi bi-eye-fill position-absolute top-50 end-0 translate-middle" :class="{ 'pb-4': errors.password }"></i>
                            <span class="text-white">{{ errors.password ? errors.password[0] : '' }}</span>
                            <label for="password" class="col-form-label">Senha</label>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-dark" type="submit">Login</button>
                            <router-link class="btn btn-secondary" to="/register">Cadastro</router-link>
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
    name: 'Login',
    data: function () {
        return {
            email: '',
            password: '',
            message: '',
            errors: [],
            show: false,
            type: 'password',
        };
    },
    created: function () {
        document.title = 'Sistema LaraVue :: Login';
    },
    methods: {
        login: async function () {
            try {
                let response = await api.login(this.email, this.password);

                if (response.data) {
                    localStorage.setItem('token', response.data.token);
                    this.$router.push('/');
                }

                if (response.response.data) {
                    if (response.response.data.errors) {
                        this.errors = response.response.data.errors;
                    } else if (response.response.data.message) {
                        this.message = response.response.data.message;
                        this.email = '';
                        this.password = '';
                        this.errors = [];

                        setTimeout(() => {
                            this.message = '';
                        }, 15000);
                    }
                }
            } catch (error) {
                return error;
            }
        },
        showPassword: function () {
            this.show = !this.show;
            if (this.show) {
                this.type = 'text';
            } else {
                this.type = 'password';
            }
        },
    },
};
</script>

<style scoped></style>
