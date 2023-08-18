<template>
<transition name="modal-animation">
    <div v-show="modalActive" class="modal">
        <div class="modal-background" @click="close" ></div>
        <transition name="modal-animation-inner"></transition>
        <div v-show="modalActive" class="modal-inner">
            <div @click="close" class="times">&times</div>

            <slot />
            <button @click="close" type="button" class="closeButton">Close</button>
        </div>
    </div>
</transition>
</template>

       
<script>

export default {


    data: () => ({
    }),

    props: ['modalActive'],

    components:{
    },

    setup(props, {emit}){
        const close = () => {
            emit("close");
        };

        return {close};
    },

}
</script>             

<style lang="scss" scoped>
.modal {
    display:flex;
    justify-content:center;
    align-items:center;
    height:100%;
    width:100%;
    position:fixed;
    top:0;
    left:0;

.modal-background{
    background-color: rgba(255,255,255,0.4);
    display:flex;
    justify-content:center;
    align-items:center;
    height:100%;
    width:100%;
    position:fixed;
    top:0;
    left:0;
}

.modal-inner{
    position:relative;
    padding: 64px 16px;
    width:50%;
    background-color: rgba(255, 255, 255, 1.0);
    border:1px solid black;

.times{
    position:absolute;
    top:15px;
    right:15px;
    font-size:20px;
    cursor:pointer;

    &:hover{
     color: cyan;
    }
}
}

}

.modal-animation-enter-active,
.modal-animation-leave-active{
    transition: opacity 0.2s cubic-bezier(0.52,0.02,0.19,1.02);
}

.modal-animation-enter-from,
.modal-animation-leave-to{
    opacity:0;
}

.modal-animation-inner-enter-active{
    transition: opacity 0.2s cubic-bezier(0.52,0.02,0.19,1.02) 0.15s;
}

.modal-animation-inner-leave-active{
    transition: opacity 0.2s cubic-bezier(0.52,0.02,0.19,1.02);
}

.modal-animation-inner-enter-from{
    opacity:0;
    transform:scale(0.8);
}


</style>
                                                        
                                                    
                                                            
                                                        