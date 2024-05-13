<style>

        /* Estilos para el texto dentro del formulario */
        .form-text {
            font-size: 15px; /* Tamaño de letra de 20 */
            color: black; /* Color de texto negro */
            font-family: 'Nunito', sans-serif; /* Fuente Nunito */
        }

        /* Estilos para el botón personalizado */
        .custom-btn {
            background-color: #6F9292; /* Color de fondo personalizado */
            border-color: #6F9292; /* Color del borde personalizado */
            box-shadow: none; 
            border: 1px solid transparent;
        }

        /* Estilos para el botón personalizado al pasar el mouse */
        .custom-btn:hover {
            background-color: #326565; /* Color de fondo personalizado al pasar el mouse */
            border-color: #326565; /* Color del borde personalizado al pasar el mouse */
            
        }

</style>
<div id="EditProfileModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black" class="modal-title">Editar Perfil</h5>
                <button type="button" aria-label="Close" class="close outline-none" data-dismiss="modal">×</button>
            </div>
            <form method="POST" id="editProfileForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="alert alert-danger d-none" id="editProfileValidationErrorsBox"></div>
                    <input type="hidden" name="user_id" id="pfUserId">
                    <input type="hidden" name="is_active" value="1">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Nombre:</label><span class="required text-danger">*</span>
                            <input type="text" name="name" id="pfName" class="form-control" required autofocus tabindex="1">
                        </div>
                        <div class="form-group col-sm-6 d-flex">
                            <div class="col-sm-4 col-md-6 pl-0 form-group">
                                <label>ícono de imagen:</label>
                                <br>
                                <label
                                        class="image__file-upload btn custom-btn text-white"
                                        tabindex="2" title="Importar imagen"> Subir
                                    <input type="file" name="photo" id="pfImage" class="d-none" >
                                </label>
                            </div>
                            <div class="col-sm-3 preview-image-video-container float-right mt-1">
                                <img id='edit_preview_photo' class="img-thumbnail user-img user-profile-img profilePicture"
                                     src="{{asset('img/usuario_@.png')}}"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Correo electronico:</label><span class="required text-danger">*</span>
                            <input type="text" name="email" id="pfEmail" class="form-control" required tabindex="3">
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" style="color:white" class="btn custom-btn" id="btnPrEditSave" data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing..." tabindex="5" title="Guardar cambios">Actualizar</button>
                        <button type="button" class="btn btn-light ml-1 edit-cancel-margin margin-left-5"
                                data-dismiss="modal" title="Cancelar cambios">Cancelar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

