<template>
    <Container />
</template>

<script>
import Container from '../../components/Container.vue';
import { api } from '../../services/ApiService';

export default {
    name: 'MyAccount',
    components: {
        Container,
    },
    mounted: function () {
        document.title = 'Sistema LaraVue :: My Account';
    },
    beforeRouteEnter: async function (to, from, next) {
        let response = await api.auth(localStorage.getItem('token'));

        if (response.message) {
            localStorage.removeItem('token');
            next('/login');
        } else {
            next();
        }
    },
};
</script>

<style scoped></style>
