import axios from 'axios';

const BASE = 'http://127.0.0.1:8000/api';

const axiosInstance = axios.create({
    baseURL: BASE,
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    }
});

export const api = {
    auth: async (token) => {
        try {
            const response = await axiosInstance.get('/user', {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            });
            return response;
        } catch (error) {
            return error;
        }
    },
    login: async (email, password) => {
        try {
            const response = await axiosInstance.post('/login', {
                email,
                password
            });
            return response;
        } catch (error) {
            return error;
        }
    },
    register: async (name, email, password, password_confirmation) => {
        try {
            const response = await axiosInstance.post('/register', {
                name,
                email,
                password,
                password_confirmation
            });
            return response;
        } catch (error) {
            return error;
        }
    },
    updateUser: async (name, email, password, password_confirmation) => {
        try {
            const response = await axiosInstance.put('/user', {
                name,
                email,
                password,
                password_confirmation
            }, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`
                }
            });
            return response;
        } catch (error) {
            return error;
        }
    },
    getProducts: async (page) => {
        try {
            const response = await axiosInstance.get('/products?page=' + page, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`
                }
            });
            return response;
        } catch (error) {
            return error;
        }
    },
    createProduct: async (name, description, price) => {
        try {
            const response = await axiosInstance.post('/products', {
                name,
                description,
                price
            }, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`
                }
            });
            return response;
        } catch (error) {
            return error;
        }
    },
    updateProduct: async (id, name, description, price) => {
        try {
            const response = await axiosInstance.put('/product/' + id, {
                name,
                description,
                price
            }, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`
                }
            });
            return response;
        } catch (error) {
            return error;
        }
    },
    deleteProduct: async (id) => {
        try {
            const response = await axiosInstance.delete('/product/' + id, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`
                }
            });
            return response;
        } catch (error) {
            return error;
        }
    }
}