function deleteById(route, id, name){
    
    if(confirm(`Deseja realmente excluir o registro: "${name}"`)){
        const baseUrl = window.location.origin

        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            , type:'DELETE'
            , url:`${baseUrl}/${route}`
            , async:true
            , dataType:'json'
            , data:{
                id:id
            }
            , success: function(datas){
                alert(`"${name}" Excluido com Sucesso`)
                location.reload()
            }
        })
    }
}