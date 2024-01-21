
<script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>

document.getElementById('downloadButton').addEventListener('click', function() {
    // Get the entire HTML content
    const htmlContent = document.documentElement.outerHTML;

    // Use html2pdf to generate a PDF
    html2pdf(htmlContent, {
      margin: 10,
      filename: 'page_styles.pdf',
      html2canvas: { scale: 2 },
      jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
    });
  });