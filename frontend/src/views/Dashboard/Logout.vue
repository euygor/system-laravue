<template></template>

<script>
export default {
    name: 'Logout',
    created: function () {
        localStorage.removeItem('token');
        this.$router.push('/');
    },
};
</script>

<style scoped></style>
