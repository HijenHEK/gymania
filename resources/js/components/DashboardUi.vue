
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


<style scoped >
    .dashboard {
        display: flex;
        width: 100%;
        height: 100%;
        position: relative;
        background-color: rgb(231,232,234) ;
    }
    .menu {
        height: 100%;
        width: 20rem;
        background-color: rgb(29,38,45);
        color: rgb(148,149,153);
        transition: all 0.1s linear;
        font-family: 'Nunito', sans-serif;
        letter-spacing: 0.05rem;
        display: flex;
        flex-direction: column;

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
    
    .brand {
        font-size: 2rem;
        text-align: center;
        color: rgb(58,181,71);
        font-weight: 600;
        padding: 1rem;
        background-color: rgb(34,45,51);
    }
    .user__name {
        margin-right: 0.3rem ;
        font-size: 1.2rem;
        color: white;
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
        flex: 100%;
    }


    .menu__links .link  {
        padding: 0.5rem 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .menu__links .link:hover {
        background: rgb(39, 50, 59);
        color: white;

    }
    .icon--toggle {
        color: white;
        
    }
    .icon--power {
        color: rgb(231, 66, 66);
        
    }
    .menu__links--active {
        color : rgb(55,181,74);
    }


    @media (max-width : 800px) {
        .menu {
            position: absolute;
        }
        
    }
</style>