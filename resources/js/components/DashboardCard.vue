<template>
    <div class="card" :class="classes">
        <slot></slot>
    </div>
</template>

<script>
export default {
    props : ['color'],
    computed : {
        classes (){
            return 'card-'+this.color
        }
    }
}
</script>

<style scoped>
    .card {
        min-width: 150px;
        min-height: 100px;
        max-width: 400px;
        max-height: 100px;
        display: flex;
        flex-direction: column;
        border-radius: 5px;
        padding: 1rem;
        margin: 0.5rem 1rem;
        }
    .card-blue {
        background-color: rgb(40,192,239);
        box-shadow: 0 0 1px 1px rgb(40,192,239);
                color: white;

        }
        .card-green {
        background-color:rgb(29,167,90);
        color: white;
        box-shadow: 0 0 1px 1px rgb(29,167,90);
        }
        .card-yellow {
        background-color:rgb(243,156,18);
        color: white;
        box-shadow: 0 0 1px 1px rgb(243,156,18);
        }
                .card-red {
        background-color: rgb(221,75,57);
        color: white;
        box-shadow: 0 0 1px 1px rgb(221,75,57);
        }
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 1.1rem;
        font-weight: 600;
        padding: 0 1rem;
        font-family: 'Changa', 'Arial Narrow', Arial, sans-serif;
        }

        .title {
            

        }
        .side-meta {
            
            margin-left: 2rem ;

        }

        @media (max-width : 800px) {
            .header {
        
                font-size: 1rem;
            
            }
        }
</style>