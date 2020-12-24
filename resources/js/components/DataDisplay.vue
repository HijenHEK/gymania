<template>
    <div :class="rows ? 'data' : 'data-card' ">
        <slot></slot>
    </div>
</template>

<script>
export default {
    props : ['rows']
}
</script>

<style scoped>

    .data {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        margin: 0.5rem 0;
        box-shadow: 0 0 2px 1px rgb(158, 158, 158);
        width: 100%;
        max-width: 1100px;
        margin: 0.5rem auto;
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
        vertical-align: middle;
        padding: 0 1rem;

    }
    
    .data-card {
        flex-direction: column;
        align-items: center;
        width: 12rem;
        height: 17rem;
        display: flex;
        background-color: white;
        margin: 0.5rem;
        border-radius: 10px;
        box-shadow: 0 0 2px 0 rgb(158, 158, 158)   ;
        padding: 1rem 0.5rem;
        cursor: pointer;
    }
    .data-card > * {
        
        padding: 0.5rem 0;
        word-wrap: none;

    }
    .data-card .avatar {
        width: 8rem;
        height: 8rem;
    }
    .avatar {
        width: 4rem;
        height: 4rem;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border-radius: 100%;
        flex-grow: unset;
        flex-basis: unset;

    }
    .id {
        flex-basis: 3rem;
        flex-grow: 0.1;
    }
    .avatar img {
        width: 100%;
    }
    .param .icon {
        margin: 0.2rem;
        cursor: pointer;
    }
</style>