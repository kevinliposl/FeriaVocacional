<?php
$session = SSession::getInstance();

if (isset($session->email)) {
    //include_once 'public/headerUser.php';
} else {
    include_once 'public/header.php';
}
?>

<!-- Page Title
============================================= -->
<section id="page-title">

    <div class="container clearfix">
        <h1>Insertar Administrador</h1>
    </div>
</section><!-- #page-title end -->

<!-- Content
============================================= -->
<section id="content">
    <div class="content-wrap">
        <div class="container clearfix">
            <div class="accordion-lg divcenter nobottommargin" style="max-width: 550px;">
                <div class="acctitle">
                    <div class="acc_content clearfix">
                        <form id="form" class="nobottommargin" onsubmit="return validate();">
                            <div class="col_full">
                                <label for="form-id">Cedula:</label>
                                <input type="text" id="form-id" class="form-control" required/>
                                <input type="hidden" id="failed-id" data-notify-type= "error" data-notify-position="bottom-full-width"/>
                            </div>

                            <div class="col_full">
                                <label for="form-email">Correo Electronico:</label>
                                <input type="email" id="form-email" class="form-control" required/>
                                <input type="hidden" id="failed-email" data-notify-type= "error" data-notify-position="bottom-full-width"/>
                            </div>

                            <div class="col_full">
                                <label for="form-name">Nombre:</label>
                                <input type="text" id="form-name" class="form-control" required/>
                                <input type="hidden" id="failed-name" data-notify-type= "error" data-notify-position="bottom-full-width"/>
                            </div>

                            <div class="col_full">
                                <label for="form-firstlastname">Primer Apellido:</label>
                                <input type="text" id="form-firstLastName"class="form-control" required/>
                                <input type="hidden" id="failed-firstLastName" data-notify-type="error" data-notify-position="bottom-full-width"/>
                            </div>

                            <div class="col_full">
                                <label for="form-secondlastname">Segundo Apellido:</label>
                                <input type="text" id="form-secondLastName" class="form-control" required />
                                <input type="hidden" id="failed-secondLastName" data-notify-type= "error" data-notify-position="bottom-full-width"/>
                            </div>

                            <div class="col_full nobottommargin">                      
                                <input type="submit" value="Insertar" class="button button-3d button-black nomargin form-control" style="display: block; text-align: center;"/>
                                <input type="hidden" id="warning"/>
                                <input type="hidden" id="success"/>
                                <input type="hidden" id="failed"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section><!-- #content end -->

<!--MODAL -->
<a id="showModal" style="display: none;"class="button button-3d button-black nomargin" data-target="#myModal" data-toggle="modal">Modal</a>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">¡Aviso!</h4>
                </div>
                <div class="modal-body">
                    <h4 style="text-align: center;">¿Realmente desea insertar este Administrador?</h4>
                    <p>Consejos:
                    <li>Revisar que todos los campos tengan la informaci&oacute;n correcta</li>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="button" class="btn btn-primary button-black nomargin" id="form-submity" value="Insertar"/>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function validate() {
        var id, email, name, firstLastName, firstLastName, secondLastName;

        id = $("#form-id").val().trim();
        email = $("#form-email").val().trim();
        name = $("#form-name").val().trim();
        firstLastName = $("#form-firstLastName").val().trim();
        secondLastName = $("#form-secondLastName").val().trim();

        if (isNaN(id) ||id.length < 9 || id.length > 9 || id.split(" ", 2).length > 1) {
            $("#failed-id").attr("data-notify-msg", "<i class=icon-remove-sign></i> Cedula Incorrecta. Complete e intente de nuevo!");
            SEMICOLON.widget.notifications($("#failed-id"));
            return false;

        } else if (!/\w+@\w+\.+[a-z]/.test(email) || email.split(" ", 2).length > 1) {
            $("#failed-email").attr("data-notify-msg", "<i class=icon-remove-sign></i> Correo Incorrecto. Complete e intente de nuevo!");
            SEMICOLON.widget.notifications($("#failed-email"));
            return false;

        } else if (name.length < 4 || name.split(" ", 2).length > 1) {
            $("#failed-name").attr("data-notify-msg", "<i class=icon-remove-sign></i> Nombre Incorrecto. Complete e intente de nuevo!");
            SEMICOLON.widget.notifications($("#failed-name"));
            return false;

        } else if (firstLastName.length < 4 || firstLastName.split(" ", 2).length > 1) {
            $("#failed-firstLastName").attr("data-notify-msg", "<i class=icon-remove-sign></i> Primer Apellido Incorrecto. Complete e intente de nuevo!");
            SEMICOLON.widget.notifications($("#failed-firstLastName"));
            return false;

        } else if (secondLastName.length < 4 || secondLastName.split(" ", 2).length > 1) {
            $("#failed-secondLastName").attr("data-notify-msg", "<i class=icon-remove-sign></i> Segundo Apellido Incorrecto. Complete e intente de nuevo!");
            SEMICOLON.widget.notifications($("#failed-secondLastName"));
            return false;
        }
        $('#showModal').click();
        return false;
    }

    //Insert
    $("#form-submity").click(function () {
        var parameters = {
            "id": $("#form-id").val().trim(),
            "email": $("#form-email").val().trim(),
            "name": $("#form-name").val().trim(),
            "firstLastName": $("#form-firstLastName").val().trim(),
            "secondLastName": $("#form-secondLastName").val().trim()
        };

        $.post("?controller=Admin&action=insertAdmin", parameters, function (data) {
            if (data.result === "1") {
                $("#success").attr({
                    "data-notify-type": "success",
                    "data-notify-msg": "<i class=icon-ok-sign></i> Operacion Exitosa!",
                    "data-notify-position": "bottom-full-width"
                });
                SEMICOLON.widget.notifications($("#success"));
                location.href = "?controller=Admin&action=insert";
            } else {
                $("#warning").attr({
                    "data-notify-type": "warning",
                    "data-notify-msg": "<i class=icon-warning-sign></i> El Administrador ya existe en el Sistema!",
                    "data-notify-position": "bottom-full-width"
                });
                SEMICOLON.widget.notifications($("#warning"));
            }
            ;
        }, "json");
    });
</script>

<!-- End Content
============================================= -->    
<?php
include_once 'public/footer.php';
