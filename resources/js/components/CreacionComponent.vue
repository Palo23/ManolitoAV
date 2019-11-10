<template>

<div class="container">
    <div class="card-body">
        <div class="card-header d-flex justify-content-between align-items-center">
        <div id="busqueda" class="col-sm-12 col-md-4 hidden-sm hidden-xs" style="border-radius: 2px; padding-bottom: 2px;">
            <h2>Buscar curso</h2>
            <input type="text" class="form-control" placeholder="Buscar" v-model="nombreCurso">
        </div>
        <button class="p-2 bd-highlight btn btn-success" @click="modalCrear">Crear Curso</button>
    </div>
    </div>

    <table style="table-layout: fixed; width: 100%;" class="table">
                            <thead>
                                <tr>
                                <th scope="col">Nombre del curso</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Imagen</th>
                                <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <lista-componente
                                    v-for="(curso, index) in searchCurso"
                                    :key="curso.id"
                                    :curso="curso"
                                    @actualizar="updateCurso(index, ...arguments)"
                                    @borrar="borrarCurso(index)"
                                ></lista-componente>
                             </tbody>
                         </table>

<div class="modal fade" id="crearModal" tabindex="-1" role="dialog" aria-labelledby="crearModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear Curso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <modal-componente
        @new="agregarCurso"
        ></modal-componente>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>


</div>


</template>

<script>
export default {
    data() {
        return {
            cursos: [],
            nombreCurso: ''
        }
    },
    mounted() {
        this.nombreCurso = '';
        axios.get('/cursosCreacion')
        .then((res) => {
            this.cursos = res.data;
        });
    },
    methods: {
        modalCrear(){
                $('#crearModal').modal({});
            },
        agregarCurso(nuevoCurso){
            $('#exampleModal').modal('hide');
        },
        updateCurso(index, curso){
            this.cursos[index] = curso;
            this.nombreCurso = '';
        axios.get('/cursosCreacion')
        .then((res) => {
            this.cursos = res.data;
        });
        },
        borrarCurso(index, curso){
            this.cursos.splice(index, 1);
            this.nombreCurso = '';
            axios.get('/cursosCreacion')
            .then((res) => {
            this.cursos = res.data;
            });
        },
    },
    computed:{
		searchCurso: function(){
			if(this.nombreCurso === ''){
			    return this.cursos;
			}else{
				return this.cursos.filter((curso)=>{
                return curso.nombre.toLowerCase().includes(this.nombreCurso.toLowerCase()) ||
                curso.description.toLowerCase().includes(this.nombreCurso.toLowerCase())
				});
			}
		},
	}
}
</script>