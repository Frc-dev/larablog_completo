<template>
    <div class="col-8 ofsset-2">
        <div class="card">
            <div class="card-header">
                <h6>Contáctame</h6>
            </div>
            <div class="card-body">

                <form @submit.prevent="onSubmit" class="contact">

                    <BaseInput label="Nombre" v-model="form.name" ></BaseInput>



                    <BaseInput label="Apellido" v-model="form.surname" ></BaseInput>
                    <BaseInput
                        label="Email"
                        type="email"
                        v-model="form.email"
                    ></BaseInput>
                    <BaseInput
                        label="Telefono"
                        v-model="form.phone"
                        :mask="'(##) ###-###-###'"
                    ></BaseInput>

                    <div class="form-group">
                        <label>Nombre</label>
                        <input v-model="form.name" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Apellido</label>
                        <input v-model="form.surname" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input v-model="form.email" type="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Teléfono</label>
                        <input v-model="form.phone" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Contenido</label>
                        <textarea v-model="form.content" class="form-control"></textarea>
                    </div>

                    <button :disabled= "formValid" type="submit" class="btn btn-primary" value="Enviar"><i class="fa-gg"></i></button>
                    <button class="btn btn-danger btn-sm" @click="resetForm">Limpiar</button>
                </form>
            </div>
        </div>

    </div>
</template>

<script>
    import BaseInput from "./BaseInput";
    import { required, minLength } from 'vuelidate/lib/validators'
    export default {
        components: {BaseInput},
        created(){
        },
        data() {
            return{
                form:{
                    name: "andres",
                    surname: "",
                    email: "",
                    phone: "",
                    content: ""
                }
            }
        },
        methods: {
            onSubmit(){
                if($this.formValid){
                    axios.post('/api/contact',{
                        name: this.$v.form.name.$model,
                        surname: this.$v.form.surname.$model,
                        email: this.$v.form.email.$model,
                        message: this.$v.form.message.$model,
                        phone: this.$v.form.phone.$model,
                    }).then(function(response) {
                        this.$awn.success('Bien');
                    })
                 }else{
                    console.log('Form enviado mal');
                }
            },
            resetForm(){

                this.$v.$reset()

                document.querySelectorAll("form.contact input, form.contact textarea")
                    .forEach(e => e.value="")
                this.$awn.info('Vale');

            }
        },
        computed:{
            formValid(){
                return !this.$v.$invalid
                /*return this.form.name.length > 0 &&
                this.form.surname.length > 0 &&
                this.form.phone.length > 0 && this.form.email.length > 0 &&
                this.form.content.length > 0
*/
            }
        },
        validations:{
            form:{
                name: required,
                minLength: minLength(3)
            }
        }
    };
</script>
<style lang="scss">
    @import '~vue-awesome-notifications/dist/styles/style.scss';
</style>
