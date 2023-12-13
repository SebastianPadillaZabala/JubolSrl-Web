// Obtén los valores necesarios para el código QR
var sucursal = document.getElementById("sucursal").value;
var empresa = document.getElementById("empresa").value;
var usuarioId = document.getElementById("usuarioId").value;
var monto = 0;
var modo = 2;
var split = 0;
var share = 1;
var estatico = 1;

// Crear el objeto JSON con los datos necesarios
var qrJson = {
  sucursal: sucursal,
  empresa: empresa,
  usuarioId: usuarioId,
  monto: monto,
  modo: modo,
  split: split,
  share: share,
  estatico: 1,
};

// Convertir el objeto JSON a una cadena
var contenidoQR = JSON.stringify(qrJson);

// Generar el código QR utilizando la biblioteca QRCode.js
var qrcode = new QRCode(document.getElementById("codigo_img"), {
  text: contenidoQR,
  width: 350,
  height: 350,
});

// Obtén el nombre de la sucursal
var nombreSucursal = empresa;

// Elimina los espacios en el nombre de la sucursal
var nombreImagen = nombreSucursal.replace(/ /g, "");

// Agregar un evento de escucha al botón de descarga
var downloadButton = document.getElementById("downloadButton");
downloadButton.addEventListener("click", function () {
  // Obtener la imagen generada del código QR
  var qrImageDataUrl = document
    .getElementById("codigo_img")
    .querySelector("canvas").toDataURL("image/png");

  // Crear el nombre de archivo personalizado
  var fileName = nombreImagen + "_qr.png";

  // Crear un enlace temporal para la descarga
  var link = document.createElement("a");
  link.href = qrImageDataUrl;
  link.download = fileName;
  link.style.display = "none";
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
});
