<template>
    <div>
        <slot></slot>
    </div>
</template>
<script>
export default {
    
}
</script>

<style scoped>
.data {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        box-shadow: 1px 1px 1px 1px rgb(200, 200, 200)   ;
        width: 100%;
        max-width: 1100px;
        margin: 0.3rem auto;
        background-color: white;
        border-radius: 5px;
        overflow: hidden;
        cursor: pointer;
        

    }
    .data > * {
        flex-basis: 4rem;
        flex-grow: 1;
        flex-shrink: 1;
        padding: 1rem 0.5rem;
        font-size: 0.9rem;
        word-wrap: none;
        text-align: center;

    }
    .data-card {
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-width: 12rem;
        width: 15rem;
        flex-basis: 15rem;
        flex-grow: 0.5;
        max-width: 18rem;
        display: flex;
        color: rgb(48,59,65);
        background-color:  rgb(240, 240, 243);
        margin: 0.5rem;
        border-radius: 10px;
        padding :1rem 0.5rem;

        box-shadow: 1px 1px 1px 1px rgb(200, 200, 200)   ;
        cursor: pointer;
    }
    .data:hover ,.data-card:hover {
        
        box-shadow: 1px 1px 1px 2px rgb(200, 200, 200)   ;
    }
    .data:active:hover ,.data-card:active:hover {
        box-shadow: 1px 1px 1px 2px rgb(200, 200, 200)   ;
    }
    .data-card > * {
        width: 100%;
        padding: 0.2rem 0;
        text-align: center;

    }
    .data-card .avatar {
        width: 10rem;
        height: 10rem;
        margin : 1rem;
    }
    .avatar {

        width: 3rem;
        height: 3rem;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border-radius: 100%;
        flex-grow: unset;
        flex-basis: unset;
        box-shadow: 0px 0px 1px 1px rgb(212, 212, 212);

    }
    .data-card .id {
        flex-basis: unset;

    }
    .id {
        flex-basis: 3rem;
        flex-grow: 0.1;
        font-weight: 600;
    }
    
    .avatar img {
        width: 140%;
    }
    .data-card .avatar img {
        width: 120%;
    }
    .name {
        font-weight: 600;
    }
    .data-card .name {
    margin-bottom: 1rem;
        
    }    
    .data .avatar {
        margin : 0.1rem 0.5rem;
    }
</style>