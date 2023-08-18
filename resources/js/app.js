import PortalVue from 'portal-vue'
import {createApp} from 'vue/dist/vue.esm-bundler.js'
import App from './App.vue'
import '../css/app.css';
import router from "./router"
import axios from 'axios'


const app = createApp(App);

app.use(PortalVue)
app.use(router)
app.mount("#app");
                                                        
                                                    
                                                            
                                                        