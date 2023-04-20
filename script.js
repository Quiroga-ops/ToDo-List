// Obtener el objeto video
const video = document.querySelector('video');

// Obtener el botón de grabar
const recordButton = document.querySelector('button#record');

// Inicializar la variable de registro
let mediaRecorder;

// Solicitar acceso a la cámara del usuario
navigator.mediaDevices.getUserMedia({ video: true })
  .then(stream => {
    // Establecer el objeto video como la fuente del stream
    video.srcObject = stream;
    // Reproducir el stream de la cámara
    video.play();

    // Crear un objeto MediaRecorder y especificar el formato de salida
    mediaRecorder = new MediaRecorder(stream, { mimeType: 'video/webm' });

    // Crear un arreglo para almacenar los datos de la grabación
    const chunks = [];

    // Escuchar el evento "dataavailable" del objeto MediaRecorder
    mediaRecorder.addEventListener('dataavailable', event => {
      // Agregar los datos de la grabación al arreglo
      chunks.push(event.data);
    });

    // Escuchar el evento "stop" del objeto MediaRecorder
    mediaRecorder.addEventListener('stop', () => {
      // Crear un objeto Blob a partir de los datos de la grabación
      const blob = new Blob(chunks, { type: 'video/webm' });

      // Crear un objeto URL para el Blob
      const url = URL.createObjectURL(blob);

      // Crear un enlace para descargar el video grabado
      const a = document.createElement('a');
      a.href = url;
      a.download = 'video.webm';
      a.click();

      // Liberar la URL del objeto Blob
      URL.revokeObjectURL(url);
    });

    // Escuchar el evento "click" del botón de grabar
    recordButton.addEventListener('click', () => {
      if (mediaRecorder.state === 'inactive') {
        // Comenzar la grabación
        mediaRecorder.start();
        recordButton.textContent = 'Detener';
      } else {
        // Detener la grabación
        mediaRecorder.stop();
        recordButton.textContent = 'Grabar';
      }
    });
  })
  .catch(error => {
    console.error('Error al acceder a la cámara: ', error);
  });

  