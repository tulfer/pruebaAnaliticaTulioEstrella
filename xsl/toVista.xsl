<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">
  <xsl:apply-templates/>
</xsl:template>

<xsl:template match="RtaBuscarArchivo">
<section class="welcome p-t-10">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <h1 class="title-4">Archivos Cargados
                <span>Analitica</span>
            </h1>
            <a href='index.php?ruta=archivos&amp;accion=cantidad'>Cantidad Archivos</a>
            <table class="table">
                <tr>
                <th style="text-align:left">Id</th>
                <th style="text-align:left">Nombre</th>
                </tr>
                <xsl:for-each select="Archivo">
                <tr>
                <td><xsl:value-of select="id" /></td>
                <td><xsl:value-of select="nombre" /></td>
                </tr>
                </xsl:for-each>
            </table>
            </div>
        </div>
    </div>
</section>
</xsl:template>

</xsl:stylesheet>