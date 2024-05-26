async function print(element, outputName) {
  //   window.jsPDF = window.jspdf.jsPDF;

  //   const doc = new jsPDF({
  //     unit: "px",
  //     orientation: "portrait",
  //     format: "a4"
  //   });
  let elementHTML = document.getElementById(element);

  //   html2canvas(elementHTML).then(function (canvas) {
  //     console.log(canvas);
  //     const imageProperties = doc.getImageProperties(canvas);

  //     doc.addImage(canvas, "JPEG", 40, 40, 400, 250);
  //     doc.save(outputName);
  //   });
  /**
 *elementHTML, {
      jsPDF: {
        format: "a4",
        unit: "mm",
      },
      html2canvas: { scale: 2 },
      imageType: "image/jpeg",
      margin: {
        top: 20,
        right: 30,
        bottom: 20,
        left: 30,
      },
      output: outputName,
    }
 */
  html2PDF(elementHTML, {
    jsPDF: {
      format: "a4",
      unit: "px",
    },
    html2canvas: { scale: 2 },
    imageType: "image/jpeg",
    margin: {
      top: 120,
      right: 30,
      bottom: 20,
      left: 30,
    },
    output: outputName,
    success: (pdf) => {
      const loadImage = pdf.loadImageFile(
        "/thesis/public/assets/print_header.png"
      );
      pdf.addImage(loadImage, "PNG", 22, 0, 400, 120);
      pdf.save(outputName);
    },
  });
}

function printWithoutHeader(element, outputName) {
  html2PDF(element, {
    jsPDF: {
      format: "a4",
      unit: "px",
    },
    html2canvas: { scale: 2 },
    imageType: "image/jpeg",
    margin: {
      right: 30,
      bottom: 20,
      left: 30,
    },
    output: outputName,
    success: (pdf) => {
      pdf.save(outputName);
    },
  });
}
