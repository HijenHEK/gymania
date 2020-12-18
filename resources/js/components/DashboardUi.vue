
<script>
    export default {
        data () {
            return {
                compact : false,
            }
        },
        mounted() {

            window.addEventListener('resize' , ()=> {{
                if(window.innerWidth < 800) this.compact = true ;
                else this.compact = false;
            }})
        }
    }
</script>


<style scoped>
    .dashboard {
        display: flex;
        width: 100%;
        height: 100%;
        position: relative;
    }
    .menu {
        height: 100%;
        width: 20rem;
        background-color: rgb(43, 43, 43);
        color: white;
        transition: all 0.1s ease;

    }
    .menu__header {
        padding: 1rem 1rem;
        font-size: 1.1rem;
    }
    .menu--compact {
        flex: unset;
        position: absolute;
        transform: translateX(-16rem);
        width: 20rem !important;
        transition: all 0.2s ease;
    }
    .content {
        flex: 100%;
        height: 100%;
        padding: 2rem 2rem 2rem 5rem;

    }

    .content--expend {
        
        padding: 2rem;

    }
    .user {
        display: flex;
        align-items: center;
    }
    .user__name {
        margin-right: 0.3rem ;
    }
        .user__role {
        font-size: 0.8rem;
    }
    .bars {
        margin-left: auto ;
        cursor: pointer;
    }
    .menu__links {
        display: flex;
        flex-direction: column;
    }


    .menu__links > *  {
        padding: 0.5rem 1rem;
    }

    .menu__links > *:hover {
        background: white;
        color: black;

    }
    


    @media (max-width : 800px) {
        .menu {
            position: absolute;
        }
        
    }
</style>