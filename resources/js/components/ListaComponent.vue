<template>
                                <div>
                                    <table style="table-layout: fixed; width: 400%;" class="table">
                                        <div v-if="error" class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>No se cambió ningún campo</strong>
                                        </div>
                                    <tr>
                                        <th>
                                        <input v-if="modoEdicion" id="" class="form-control" type="text" v-model="curso.nombre">
                                        <p v-else><a :href="`/vistageneral/${curso.id}`">{{curso.nombre}}</a></p>
                                        </th>
                                        <td>
                                            <input v-if="modoEdicion" id="" class="form-control" type="text" v-model="curso.description">
                                            <p v-else>{{curso.description}}</p>
                                            </td>
                                        <td>
                                            <a :href="`/editarCurso/${curso.id}`"><img width="50" height="50" :src="curso.archivo.ruta" alt="..."></a></td>
                                        <td>
                                            <div v-if="modoEdicion">
                                                <button class="btn btn-success" type="submit" @click="actualizarCurso">Guardar Cambios</button>
                                                <button class="btn btn-danger" type="submit" @click="cancelar">Cancelar</button>
                                            </div>
                                            <div v-else>
                                                <a class="btn btn-primary" @click="editar">Editar</a>
                                                <button class="btn btn-secondary" type="submit" @click="modalDelCurso">Eliminar</button>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                </div>
</template>
<script>
export default {
        props: ['curso'],
        data() {
            return {
                prop: {id: '', nombre: '', description: '', foto: ''},
                modoEdicion: false,
                modoEliminar: false,
                toDeleteCursoId: '',
                nombre: '',
                descripcion: '',
                error: false
            }
        },
        methods: {
            editar(){
                this.modoEdicion = true;
            },
            cancelar(){
                this.modoEdicion = false;
            },
            actualizarCurso(){
                const params = {
                    nombre: this.curso.nombre,
                    descripcion: this.curso.description
                };
                if (this.curso.nombre === '' || this.curso.descripcion === '') {
                    this.$swal({
                            title: 'Campos vacíos',
                            text: 'No se permiten campos vacíos al editar',
                            type: 'error'
                                });
                } else {
                    axios.put(`/cursosCreacion/${this.curso.id}`, params).then((res) => {
                    this.modoEdicion = false;
                    const curso = res.data;
                    this.$emit('actualizar', curso)
                })
                }
            },
            modalDelCurso(){
                var id
                var authID
                authID = this.user.id
                id = this.curso.id
                Vue.swal({
                    title: "¿Estás seguro de eliminar el curso?",
                    text: `${this.curso.nombre}`,
                    type: "question",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Sí",
                    showCancelButton: true,
                    cancelButtonText: "Cancelar"
                    }).then(function(isConfirm) {
                            if (isConfirm.value) {
                                    axios.delete(`/cursosCreacion/${id}`).then((res) => {
                                        Vue.swal({
                                            title: "Eliminado", 
                                            text: "El curso ha sido eliminado", 
                                            type: "success",
                                            allowEscapeKey: false,
                                            allowOutsideClick: false}).then(function(){ 
                                            location.reload();
                                            });
                                    });
                                }
                            });
            },
        },
    }
</script>