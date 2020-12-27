<template>
    <nav v-if="data" role="navigation" aria-label="Pagination Navigation" class="nav">
        <div class="sm">
                <span v-if="data.current_page == 1" class="icon">
                    <svg  fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
                <div v-else @click="changePage(data.current_page - 1)"  class="icon">
                    <svg  fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div v-if="data.last_page > data.current_page" @click="changePage(data.current_page + 1)" class="icon">
                    <svg  fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <span v-else  class="icon">
                    <svg  fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
        </div>
        <div class="lg">
            <div class="meta">
                <span>Showing</span>
                <span>{{ data.from }}</span>
                <span>to</span>
                <span> {{ data.to }}</span>
                <span>of</span>
                <span>{{ data.total }}</span>
                <span>results</span>
            </div>
            <div class="links">
            <!-- Previous Page Link -->
                <span v-if="data.current_page == 1" aria-disabled="true" aria-label="pagination.previous" >
                    <span  aria-hidden="true" class="icon icon-disabled" >
                        <svg  fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </span>
                <a v-else @click="changePage(data.current_page - 1)" rel="prev" class="icon"  aria-label="pagination previous">
                    <svg  fill="currentColor" viewBox="0 0 20 20" >
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
                <!-- Pagination Elements -->
                <div v-for="(link , i) in data.links" :key="i" >
                    <span v-if="link === '...' " aria-disabled="true">
                        <span  class="link">{{ link }}</span>
                    </span>
                    <!-- Array Of Links -->
                    <div v-else>
                        <div v-if="!(i == 0 || i == Object.keys(data.links).length - 1)">
                            <span v-if="link.label == data.current_page" aria-current="page">
                                <span  class="link active">{{ link.label }}</span>
                            </span>
                            <div class="link" v-else-if="isNaN(link.label)"  :aria-label="'Go to page :' + link.label ">
                                {{ link.label }}
                            </div>
                            <div class="link" v-else @click="changePage(link.label)"  :aria-label="'Go to page :' + link.label ">
                                {{ link.label }}
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- Next Page Link -->
                <div v-if="data.last_page > data.current_page" @click="changePage(data.current_page + 1)" rel="next" class="icon"   aria-label="pagination.next">
                    <svg  fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <span v-else aria-disabled="true"  aria-label="pagination.next">
                    <span  aria-hidden="true" class="icon icon-disabled">
                        <svg  fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </span>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    props:{
        data : {
            default :null
        }
    },
    
    methods : {
        changePage(page) {
                this.$emit('pagination' , page)

            
        }
        
    },
    computed : {
        
    },
    mounted() {
        if(!this.data) {
            console.log('you are using LaravelVuePagination you need to provide data as a prop !');
        }else {
            console.log(this.data)
        }
        
    }
}
</script>

<style scoped>

    .nav {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.875rem;
        font-weight: 500;
    }
    
    .lg {
        flex: 1;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
    }
    .meta>* {
        margin: 0 2px ;
    }
    .links {
        display: flex;
        align-items: center;
                border: 1px solid rgb(209, 213, 219);
        border-radius: 0.375rem;
        box-shadow: 0 0 1px 1px inherit;
    }
    .sm {
        display: none;
    }
    .icon {
        position: relative;
        padding: 0.5rem;        
        display: flex;
        align-items: center;
        font-size: 0.875rem;        
        line-height: 1.5rem;
        cursor : pointer ;  
    }
    .icon-disabled {
        cursor : default ;
        color:  rgb(209, 213, 219) ;
    }
    .link {
        display: flex;
        align-items: center;
        border: 1px solid rgb(209, 213, 219);
        color:rgb(46, 47, 48) ;
        padding: 0.5rem 1rem;
        text-align: center;
        margin: -1px;
        line-height: 1.5rem;
        cursor: pointer;
        box-shadow: 0 0 1px 1px inherit;

    }
    .link.active{
        font-weight: 600;
        color: rgb(35, 51, 75);
        border-color: rgba(121, 148, 189, 0.8);
    }
    svg {
        width: 1.25rem;
        height: 1.25rem;

    }
    @media (max-width : 700px) {
        .sm {
            flex: 1;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .lg {
            display: none;
        }
        .icon {
        border: 1px solid rgb(209, 213, 219);
        border-radius: 0.375rem;
        }
    }
</style>