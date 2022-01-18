var t_venta;
function listar_venta(){
    //var finicio = document.getElementById('txt_finicio').value;
    //var ffin = document.getElementById('txt_ffin').value;
    var txt_rangofecha = ($("#txt_rangofecha").val().replace(/ /g, "")).split('/');
    var info           = txt_rangofecha[0].split('-');
    var finicio = info[2] + '-' + info[1] + '-' + info[0];
    var info2          = txt_rangofecha[1].split('-');
    var ffin = info2[2] + '-' + info2[1] + '-' + info2[0];
    t_venta = $("#tabla_ventas").DataTable({
		"ordering":false,   
        "pageLength":10,
        "destroy":true,
        "async": false ,
        "responsive": true,
    	"autoWidth": false,
        "ajax":{
            "method":"POST",
            "url":"../controlador/venta/controlador_venta_listar.php",
            data:{
                finicio:finicio,
                ffin:ffin
            }
        },
        "columns":[
            {"defaultContent":""},
            {"data":"usuario_nombre"},
            {"data":"cliente"},
            {"data":"venta_ticomprobante"},
            {"data":"venta_seriecomprobante"},
            {"data":"venta_numcomprobante"},
            {"data":"venta_fecha"},
            {"data":"venta_total"},
            {"data":"venta_impuesto"},
            {"data":"venta_estatus",
                render: function(data,type,row){
                    if(data==="REGISTRADA"){
                        return "<span class='badge badge-success badge-pill m-r-5 m-b-5'>"+data+"</span>";
                    }else{
                        return "<span class='badge badge-danger badge-pill m-r-5 m-b-5'>"+data+"</span>";
                    }
                }
            },
            {"defaultContent":"<button class='imprimir btn btn-xs btn-primary'><i class='fa fa-print'></i></button>&nbsp;<button class='anular btn btn-xs btn-danger'><i class='fa fa-trash'></i></button>"}
        ],
        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
            $($(nRow).find("td")[0]).css('text-align', 'center' );
            $($(nRow).find("td")[1]).css('text-align', 'left' );
            $($(nRow).find("td")[2]).css('text-align', 'left' );
            $($(nRow).find("td")[3]).css('text-align', 'left' );
            $($(nRow).find("td")[4]).css('text-align', 'center' );
            $($(nRow).find("td")[5]).css('text-align', 'center' );
            $($(nRow).find("td")[6]).css('text-align', 'center' );
            $($(nRow).find("td")[7]).css('text-align', 'center' );
            $($(nRow).find("td")[8]).css('text-align', 'center' );
            $($(nRow).find("td")[9]).css('text-align', 'center' );
        },
        "language":idioma_espanol,
        select: true
	});
	t_venta.on( 'draw.dt', function () {
        var PageInfo = $('#tabla_ventas').DataTable().page.info();
        t_venta.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            } );
        } );
  
}

$('#tabla_ventas').on('click','.imprimir',function(){
    var data = t_venta.row($(this).parents('tr')).data();//Detecta a que fila hago click y me captura los datos en la variable data.
    if(t_venta.row(this).child.isShown()){//Cuando esta en tamaño responsivo
        var data = t_venta.row(this).data();
    }

    window.open("../MPDF/generar_venta.php?codigo="+parseInt(data.venta_id)+"#zoom=100");
})


$('#tabla_ventas').on('click','.anular',function(){
    var data = t_venta.row($(this).parents('tr')).data();//Detecta a que fila hago click y me captura los datos en la variable data.
    if(t_venta.row(this).child.isShown()){//Cuando esta en tamaño responsivo
        var data = t_venta.row(this).data();
    }

    Swal.fire({
        title: 'Desea anular la venta',
        text: "Una vez anulado no se podran revertir el proceso",
        icon: 'success',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Anular Venta'
      }).then((result) => {
        if (result.value) {
            $.ajax({
                url:'../controlador/venta/controlador_anular_venta.php',
                type:'POST',
                data:{
                    idventa:data.venta_id
                }
            }).done(function(resp){
                if(resp>0){
                    Swal.fire("Mensaje de Confirmación","La venta fue anulada exitosamente","success");
                    t_ingreso.ajax.reload();
                }else{
                    Swal.fire("Mensaje De Error","El registro no se pudo completar","error");
                }
            })
        }
    })
})


function combo_cliente(){
    $.ajax({
        url:"../controlador/venta/controlador_cliente_combo_listar.php",
        type:'POST'
    }).done(function(resp){
        var data = JSON.parse(resp);
        var cadena = "";
        if(data.length>0){
            for (var i=0; i < data.length; i++) {
                cadena+="<option value='"+data[i][2]+"'>"+data[i][1]+" - "+data[i][0]+"</option>";
            }
            document.getElementById('cbm_cliente').innerHTML=cadena;

        }else{
            document.getElementById('cbm_cliente').innerHTML="No se encontraron datos";

        }
    })
}

var arreglo_stock = new Array();
var arreglo_precio = new Array();
function combo_producto(){
    $.ajax({
        url:"../controlador/ingreso/controlador_producto_combo_listar.php",
        type:'POST'
    }).done(function(resp){
        var data = JSON.parse(resp);
        var cadena = "";
        if(data.length>0){
            for (var i=0; i < data.length; i++) {
                cadena+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
                arreglo_stock[data[i][0]]=data[i][2];
                arreglo_precio[data[i][0]]=data[i][3];
            }
            document.getElementById('cbm_producto').innerHTML=cadena;
            document.getElementById('txt_stock').value=data[0][2];
            document.getElementById('txt_precio').value=data[0][3];
        }else{
            document.getElementById('cbm_producto').innerHTML="No se encontraron datos";
  
        }
    })
}


function Agregar_Producto_Detalle_Venta(){
    let idproducto = document.getElementById('cbm_producto').value;
    let producto = $("#cbm_producto option:selected").text();
    let cantidad = document.getElementById('txt_cantidad').value;
    let stock = document.getElementById('txt_stock').value;
    let precio = document.getElementById('txt_precio').value;
    let subtotal = precio*cantidad;
    let impuesto = document.getElementById('txt_impuesto').value;
    Boolean($("#txt_impuesto").val().length>0) ? $("#txt_impuesto").removeClass('is-invalid').addClass("is-valid") : $("#txt_impuesto").removeClass('is-valid').addClass("is-invalid"); 
    Boolean($("#txt_cantidad").val().length>0) ? $("#txt_cantidad").removeClass('is-invalid').addClass("is-valid") : $("#txt_cantidad").removeClass('is-valid').addClass("is-invalid"); 
    Boolean($("#txt_precio").val().length>0) ? $("#txt_precio").removeClass('is-invalid').addClass("is-valid") : $("#txt_precio").removeClass('is-valid').addClass("is-invalid"); 
    Boolean($("#txt_stock").val().length>0) ? $("#txt_stock").removeClass('is-invalid').addClass("is-valid") : $("#txt_stock").removeClass('is-valid').addClass("is-invalid"); 
	
    let tipo = document.getElementById('cbm_tipo').value;
    if(tipo=="FACTURA"){
        if(impuesto.length==0){
            $("#txt_impuesto").removeClass('is-valid').addClass("is-invalid"); 
            return Swal.fire("Mesaje de Advertencia","Debe llenar el impuesto antes de agregar un producto","warning");   
        }
        if(impuesto>1.00){
            $("#txt_impuesto").removeClass('is-valid').addClass("is-invalid"); 
            return Swal.fire("Mesaje de Advertencia","No puede asignarle ese impuesto","warning"); 
        }
    }
    if(cantidad.length==0 || precio.length==0){
        return Swal.fire("Mesaje de Advertencia","Llene la cantidad y el precio","warning");
    }

    if(parseFloat(stock) < parseFloat(cantidad)){
        $("#txt_cantidad").removeClass('is-valid').addClass("is-invalid"); 
        return Swal.fire("Mesaje de Advertencia","El producto no tiene el stock suficiente, <b>ingrese una cantidad menor o igual al stock</b>","warning");
    }
    if(parseInt(cantidad)<1 ){
        $("#txt_cantidad").removeClass('is-valid').addClass("is-invalid"); 
        return Swal.fire("Mesaje de Advertencia","La cantidad debe ser mayor a 0","warning");
    }

    if(parseFloat(precio)<0.1){
        $("#txt_precio").removeClass('is-valid').addClass("is-invalid"); 
        return Swal.fire("Mesaje de Advertencia","El precio debe ser mayor a 0","warning");
    }

    if(verificarid(idproducto)){
        return Swal.fire("Mesaje de Advertencia","El producto ya fue asignado a la tabla","warning");
    }
    let datos_agregar ="<tr>";
    datos_agregar+="<td for='id' hidden>"+idproducto+"</td>";
    datos_agregar+="<td>"+producto+"</td>";
    datos_agregar+="<td>"+precio+"</td>";
    datos_agregar+="<td>"+cantidad+"</td>";
    datos_agregar+="<td>"+subtotal+"</td>";
    datos_agregar+="<td><button class='btn btn-danger' onclick='remove(this)'><i class='fa fa-trash'></i></button></td>";
    datos_agregar+="</tr>";
    $("#tbody_detalle_venta").append(datos_agregar);
    SumarTotalneto();
    document.getElementById('txt_cantidad').value = "";
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
}

function verificarid(id){
    let idverficiar = document.querySelectorAll('#detalle_venta td[for="id"]');
    return [].filter.call(idverficiar, td=> td.textContent === id).length===1;
}

function remove(t){
    var td = t.parentNode;
    var tr = td.parentNode;
    var table = tr.parentNode;
    table.removeChild(tr);
    SumarTotalneto();
}

function SumarTotalneto() {
    let arreglo_total = new Array();
    let count = 0;
    let total = 0;
    let impuestototal=0;
    let impuesto = document.getElementById('txt_impuesto').value;
    let subtotal=0;
    $("#detalle_venta tbody#tbody_detalle_venta tr").each(function () {
        arreglo_total.push($(this).find('td').eq(4).text());
        count++;
    })
    for (var i = 0; i < count; i++) {
        var suma = arreglo_total[i];
        subtotal = (parseFloat(subtotal) + parseFloat(suma)).toFixed(2);//SUMA DEL SUBTOTAL
        impuestototal=parseFloat(subtotal*impuesto).toFixed(2);
    };
    total=parseFloat(subtotal)+parseFloat(impuestototal);
    let tipo = document.getElementById('cbm_tipo').value;
    if(tipo=="FACTURA"){
        $("#lbl_subtotal").html("<b>Sub Total: </b> S/."+subtotal);
        $("#lbl_impuesto").html("<b>IGV "+impuesto*100+"%: </b> S/."+impuestototal);
        $("#lbl_totalneto").html("<b>Total: </b> S/."+total.toFixed(2));
    }else{
        $("#lbl_totalneto").html("<b>Total: </b> S/."+total.toFixed(2));
        $("#lbl_subtotal").html("");
        $("#lbl_impuesto").html("");
    }
}

function Registar_Venta(){
    let count=0;
    $("#detalle_venta tbody#tbody_detalle_venta tr").each(function () {
        count++;
    })
    if(count==0){
        return Swal.fire("Mesaje de Advertencia","El detalle del ingreso debe tener un producto por lo menos","warning");
    }
    let idcliente = document.getElementById('cbm_cliente').value;
    let idusuario = document.getElementById('txt_codigo_principal').value;
    let tipo = document.getElementById('cbm_tipo').value;
    let serie = document.getElementById('txt_serie').value;
    let ncomprobante = document.getElementById('txt_ncomprobante').value;
    let total = document.getElementById('lbl_totalneto').innerHTML.substr(18);
    let impuesto = 0;
    let porcentaje = 0;
    if(tipo=="FACTURA"){
         porcentaje = document.getElementById('txt_impuesto').value;
         impuesto = document.getElementById('lbl_impuesto').innerHTML.substr(20);;
    }else{
        porcentaje = 0;
        impuesto = 0;
    }

    if(serie.length==0 || ncomprobante.length==0){
        return Swal.fire("Mesaje de Advertencia","Llene los espacios en blanco","warning"); 
    }

    $.ajax({
        url:'../controlador/venta/controlador_venta_ingreso.php',
        type:'POST',
        data:{
            idcliente:idcliente,
            idusuario:idusuario,
            tipo:tipo,
            serie:serie,
            ncomprobante:ncomprobante,
            total:total,
            impuesto:impuesto,
            porcentaje:porcentaje
        }
    }).done(function(resp){
        if(resp>0){
            Registrar_Detalle_Venta(parseInt(resp));
        }else{
            Swal.fire("Mensaje De Error","El registro no se pudo completar","error");
        }
    })
}



function Registrar_Detalle_Venta(id){
    let count=0;
    let arreglo_producto = new Array();
    let arreglo_cantidad = new Array();
    let arreglo_precio = new Array();
    $("#detalle_venta tbody#tbody_detalle_venta tr").each(function () {
        arreglo_producto.push($(this).find('td').eq(0).text());
        arreglo_cantidad.push($(this).find('td').eq(3).text());
        arreglo_precio.push($(this).find('td').eq(2).text());
        count++;
    })

    if(count==0){
        return Swal.fire("Mesaje de Advertencia","El detalle del ingreso debe tener un producto por lo menos","warning");
    }

    let producto = arreglo_producto.toString();
    let cantidad = arreglo_cantidad.toString();
    let precio = arreglo_precio.toString();
    $.ajax({
        url:'../controlador/venta/controlador_registro_venta_detalle.php',
        type:'POST',
        data:{
            id:id,
            producto:producto,
            cantidad:cantidad,
            precio:precio
        }
    }).done(function(resp){
        if(resp>0){
            Swal.fire({
                title: 'Datos Confirmaci\u00F3n',
                text: "Datos correctamente, nueva entrada registrada!",
                icon: 'success',
                allowOutsideClick: false,
                allowEscapeKey:false,
                allowEnterKey:false,
                focusConfirm:false,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Imprimir Reporte',
                cancelButtonText: 'Cerrar'
              }).then((result) => {
                if (result.value) {
                    window.open("../MPDF/generar_venta.php?codigo="+parseInt(id)+"#zoom=100");
                    $("#contenido_principal").load("../vista/venta/vista_mantenimiento_venta.php");
                }else{
                    $("#contenido_principal").load("../vista/venta/vista_mantenimiento_venta.php");
                }
              })
        }else{
            Swal.fire("Mensaje De Error","El registro no se pudo completar","error");
        }
    })

}