
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
        transition: all 0.1s linear;

    }
    .menu__header {
        padding: 2rem 1rem;
        display: flex;
        align-items: center;
    }
    .menu--compact {
        flex: unset;
        position: absolute;
        transform: translateX(-16rem);
        transition: all 0.1s linear;
    }
    .content {
        flex: 100%;
        height: 100%;
        padding: 2rem 2rem 2rem 5rem;

    }

    .content--expend {
        
        padding: 2rem;

    }
    
    .user__name {
        margin-right: 0.3rem ;
        font-size: 1.2rem;
    }
    .user__role {
        font-size: 0.8rem;
    }
    .icon {
        margin-left: auto ;
        cursor: pointer;
        
    }
    .menu__links {
        display: flex;
        flex-direction: column;
        font-size: 1.1rem;

    }


    .menu__links > *  {
        padding: 0.5rem 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
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