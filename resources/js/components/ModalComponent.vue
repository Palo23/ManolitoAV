<template>
         <div class="container">
                    <form action="" @submit.prevent="nuevoCurso">
                        <div class="form-group">
                            <label for="nombre">Nombre del Curso</label>
                            <input type="text" class="form-control" name="nombre" v-model="nombre" maxlength="25">
                            <label for="descripcion">Descripción</label>    
                            <input type="text" class="form-control" name="descripcion" v-model="descripcion" maxlength="100">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control" name="password" v-model="password">
                            <!-- <label for="fotoCurso">Imagen del curso</label>
                            <div style="overflow-x: hidden;border: 1px solid #f1f1f1; margin: 5px 0px 3px 0px;">
                                <input type="file" name="fotoCurso" v-on:change="changeFiles" ref="foto" accept=".jpg, .jpeg, .png" class="btn btn-xs">
                            </div> -->
                        </div>
                        <button class="btn btn-primary" type="submit">Crear Curso</button>
                    </form>
                </div>
</template>
<script>
export default {
    data() {
        return {
            nombre: '',
            descripcion: '',
            password: '',
            foto: '',
            cursos: [],
            comprobar: [],
            existe: false
        }
    },

    mounted() {
        axios.get('/cursosCreacion')
        .then((res) => {
            this.comprobar = res.data;
        });
    },

    methods: {
        changeFiles(){
            //obtenemos los archivos
            // se pueden asignar a un array u objeto
            console.log(this.$refs.foto.files[0].name);
        },
        nuevoCurso(){
            const params = {
                nombre: this.nombre,
                descripcion: this.descripcion,
                password: this.password
            };

            var tamanio = this.comprobar.length
            for (let i = 0; i < tamanio; i++) {
                if (this.nombre.toLowerCase() == this.comprobar[i].nombre.toLowerCase()) {
                    this.existe = true
                    break
                }
            }

            if (this.existe) {
                this.$swal({
                            title: 'Existe',
                            text: 'El curso ya existe',
                            type: 'error'
                                });
                this.nombre = '';
                this.descripcion = '';
                this.password = '';
                this.existe = false
            } else {
                if (this.nombre == '' || this.descripcion == '' || this.password == '') {
                this.$swal({
                            title: 'Campos vacíos',
                            text: 'Debes llenar todos los campos',
                            type: 'error'
                                });
                this.nombre = '';
                this.descripcion = '';
                this.password = '';
            }else{
            this.nombre = '',
            this.descripcion = '',
            this.password = '',
            axios.post('/cursosCreacion', params)
            .then((res) => {
                const nuevoCurso = res.data;
                this.$emit('new', nuevoCurso);
            });
            }
            }
        }   
    }
}
</script>