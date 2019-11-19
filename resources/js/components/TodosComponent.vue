<template>

<div class="container">

    <div id="busqueda" class="col-sm-12 hidden-sm hidden-xs">
            <h2>Buscar curso</h2>
            <input type="text" class="form-control col-sm-12" placeholder="Buscar por curso o profesor" v-model="nombreTodosCurso">
        </div>

    <div class="row">
    <curso-componente
        v-for="(curso, index) in searchTodosCursos"
        :key="curso.id"
        :curso="curso"
        @new="nuevoCurso"
    ></curso-componente>
</div>
</div>

</template>

<script>

export default {
    props: ['curso'],
    data() {
        return {
            cursos: null,
            modalShow: false,
            nombreTodosCurso: ''
        }
    },

    mounted() {
        axios.get('/inscripcion')
        .then((res) => {
            this.cursos = res.data;
        });
        console.log(this.cursos);
        
    },
    methods: {
        nuevoCurso(curso){
            axios.get('/inscripcion')
        .then((res) => {
            this.cursos = res.data;
        });
        },
        updateCurso(index, curso){
            this.cursos[index] = curso;
        },
    },
    computed:{
		searchTodosCursos: function(){
			if(this.nombreTodosCurso === ''){
			    return this.cursos;
			}else{
				return this.cursos.filter((curso)=>{
                return curso.nombre.toLowerCase().includes(this.nombreTodosCurso.toLowerCase()) ||
                curso.profesor.name.toLowerCase().includes(this.nombreTodosCurso.toLowerCase());
				});
			}
		}
	}
}

</script>