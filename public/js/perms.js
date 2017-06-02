 $(document).ready(function(){var urlActual=$(location).attr('href');var parts=urlActual.split('/');var idDoc=parts.pop();$.ajaxPrefilter(function(options,originalOptions,xhr){var token=$('meta[name="csrf-token"]').attr('content');if(token){return xhr.setRequestHeader('X-CSRF-TOKEN',token)}});$.ajax({type:'post',url:'/perms/filename',data:{id:idDoc},success:function(data){$("#legendPerms").html("Permisos sobre "+data)},error:function(response){alert("Error "+data)},complete:{}});$(function(){$('#permsTable').DataTable({retrieve:!0,processing:!0,serverSide:!0,ajax:'/perms/show/list/'+idDoc,columns:[{data:'id',name:'id'},{data:'name',name:'name'},{data:'hasPerms',render:function(data){if(data==1){return "<span>Escritura</span>"}
else{return "<span>Sin permisos</span>"}}},{data:'hasPerms',className:'text-center',render:function(data){if(data==1){return "<button class='eliminarPerm btn-link btn-xs'>Eliminar permisos</button>"}
else{return "<button class='otorgarPerm btn-link btn-xs'>Otorgar permisos</button>"}}}],'language':{"url":"/datatablesEs"},"oAria":{"sSortAscending":": Activar para ordenar la columna de manera ascendente","sSortDescending":": Activar para ordenar la columna de manera descendente"}})});$('#permsTable').on('click','.eliminarPerm',function(e){e.preventDefault();var permsTable=$('#permsTable').DataTable();var dRow=$(this).parents('tr')[0];var dData=permsTable.row(dRow).data();var idUser=dData.id;$.ajax({type:'post',url:'/perms/delete',data:{id_user:idUser,id_doc:idDoc},success:function(data){permsTable.ajax.reload()},error:function(data){alert("Error al modificar los permisos")},complete:{}})});$('#permsTable').on('click','.otorgarPerm',function(e){e.preventDefault();var permsTable=$('#permsTable').DataTable();var dRow=$(this).parents('tr')[0];var dData=permsTable.row(dRow).data();var idUser=dData.id;$.ajax({type:'post',url:'/perms/new',data:{id_user:idUser,id_doc:idDoc},success:function(data){permsTable.ajax.reload()},error:function(data){alert("Error al modificar los permisos")},complete:{}})})})
