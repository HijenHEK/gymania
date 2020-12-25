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
        min-width: 100px;
        min-height: 100px;
        width: 200px;
        height: 100px;
        display: flex;
        flex-direction: column;
        border-radius: 10px;
        padding: 1rem;
        margin: 0.5rem 1rem;
        }
    .card-blue {
        background-color: rgba(0, 113, 219, 0.8);
        box-shadow: 0 0 1px 1px rgb(0, 100, 255);
                color: white;

        }
        .card-green {
        background-color: rgba(24, 156, 7, 0.8);
        color: white;
        box-shadow: 0 0 1px 1px rgb(24, 140, 20);
        }
        .card-yellow {
        background-color: rgba(231, 222, 103, 0.8);
        color: black;
        box-shadow: 0 0 1px 1px rgb(231, 205, 115);
        }
                .card-red {
        background-color: rgba(207, 72, 48, 0.8);
        color: white;
        box-shadow: 0 0 1px 1px rgb(207, 60, 60);
        }
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 1.2rem;
        font-weight: 600;
        padding: 0 1rem;
        font-family: 'Changa', 'Arial Narrow', Arial, sans-serif;
        }

        .title {
            

        }
        .side-meta {
            
            

        }

        @media (max-width : 800px) {
            .header {
        
        font-size: 1rem;
        
        }
        }
</style>