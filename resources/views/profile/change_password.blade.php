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

<div id="changePasswordModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black" class="modal-title">Actualizar Contraseña</h5>
                <button type="button" aria-label="Close" class="close outline-none" data-dismiss="modal">×</button>
            </div>
            <form method="POST" id='changePasswordForm'>
            <div class="modal-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="alert alert-danger d-none" id=""></div>
                    <input type="hidden" name="is_active" value="1">
                    <input type="hidden" name="user_id" id="editPasswordValidationErrorsBox">
                    {{csrf_field()}}
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label>Contraseña anterior:</label><span
                                class="required confirm-pwd"></span><span class="required text-danger">*</span>
                        <div class="input-group">
                            <input class="form-control input-group__addon" id="pfCurrentPassword" type="password"
                                   name="password_current" required>
                            <div class="input-group-append input-group__icon">
                                <span class="input-group-text changeType">
                                    <i class="icon-ban icons"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Nueva contraseña:</label><span
                                class="required confirm-pwd"></span><span class="required text-danger">*</span>
                        <div class="input-group">
                            <input class="form-control input-group__addon" id="pfNewPassword" type="password"
                                   name="password" required>
                            <div class="input-group-append input-group__icon">
                                <span class="input-group-text changeType">
                                    <i class="icon-ban icons"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Confirmar contraseña:</label><span
                                class="required confirm-pwd"></span><span class="required">*</span>
                        <div class="input-group">
                            <input class="form-control input-group__addon" id="pfNewConfirmPassword" type="password"
                                   name="password_confirmation" required>
                            <div class="input-group-append input-group__icon">
                                <span class="input-group-text changeType">
                                    <i class="icon-ban icons"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" style="color:white" class="custom-btn btn" id="btnPrPasswordEditSave" data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing..." title="Guardar cambios">Actualizar</button>
                    <button type="button" class="btn btn-light ml-1" data-dismiss="modal" title="Cancelar">Cancelar
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<?php
