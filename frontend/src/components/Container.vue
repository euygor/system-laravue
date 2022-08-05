<template>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <router-link to="/" class="d-flex align-items-center pb-3 mb-md-0 text-white text-decoration-none">
                        <img class="img-fluid" src="/logo.png" alt="Imagem não encontrada." style="width: 50px; height: 50px" />
                        <span class="fs-6 d-none d-sm-inline ms-4">Sistema LaraVue</span>
                    </router-link>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start">
                        <li class="nav-item">
                            <router-link to="/" class="nav-link align-middle px-0">
                                <i class="fs-4 bi bi-cart-fill"></i>
                                <span class="ms-1 d-none d-sm-inline text-white">Produtos</span>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/my-account" class="nav-link align-middle px-0">
                                <i class="fs-4 bi bi-person-fill"></i>
                                <span class="ms-1 d-none d-sm-inline text-white">Minha Conta</span>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/logout" class="nav-link align-middle px-0">
                                <i class="fs-4 bi bi-box-arrow-left"></i>
                                <span class="ms-1 d-none d-sm-inline text-white">Sair</span>
                            </router-link>
                        </li>
                    </ul>
                </div>
            </div>
            <HomeContent v-if="this.$route.path == '/'" />
            <MyAccountContent v-if="this.$route.path == '/my-account'" />
        </div>
    </div>
</template>

<script>
import HomeContent from './HomeContent.vue';
import MyAccountContent from './MyAccountContent.vue';
import Logout from '../views/Dashboard/Logout.vue';

export default {
    name: 'Container',
    components: {
        HomeContent,
        MyAccountContent,
        Logout,
    },
};
</script>
