<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item" :class="{ disabled: source.current_page == 1 }">
                <a class="page-link" href="#" @click="nextPrev($event, source.current_page - 1)" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="page-item" :class="{ active: source.current_page == page }" v-for="(page, index) in pages" :key="index">
                <a class="page-link" href="#" @click="navigate($event, page)">{{ page }}</a>
            </li>
            <li class="page-item" :class="{ disabled: source.current_page == source.last_page }">
                <a class="page-link" href="#" @click="nextPrev($event, source.current_page + 1)" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
import { range } from 'lodash';

export default {
    name: 'Pagination',
    props: ['source'],
    data: function () {
        return {
            pages: [],
        };
    },
    methods: {
        navigate: function (e, page) {
            e.preventDefault();
            this.$emit('navigate', page);
        },
        nextPrev: function (e, page) {
            if (page == 0 || page == this.source.last_page + 1) {
                return;
            }
            this.navigate(e, page);
        },
    },
    watch: {
        source: function () {
            this.pages = range(1, this.source.last_page + 1);
        },
    },
};
</script>
