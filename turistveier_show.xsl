<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:template match="/">
        <html>
            <head>
                <meta charset="UTF-8" />
                <style>
                    h1 {font-family:Garamond;}
                    table {border-collapse:collapse;}
                    table, th, td {border:2px solid green;}
                    td, th {padding: 1px 3px 1px 8px;}
                </style>
                <title>Varanger turliste</title>
            </head>
            <body>
                <h1><xsl:value-of select="title"/>Varanger</h1>
                <table>
                    <tr><th>Sted</th><th>Latitude</th>
                        <th>Longitude</th><th>Informasjon</th>
                        <th>Vær</th>
                    </tr>
                    <xsl:apply-templates>
                        <xsl:sort select="title"/>
                    </xsl:apply-templates>
                </table>
            </body>
        </html>
    </xsl:template>
    <xsl:template match="turistveg-attraksjon">
        <tr>
            <td><xsl:value-of select="title"/></td>
            <td><xsl:value-of select="latitude"/></td>
            <td><xsl:value-of select="longitude"/></td>
            <td><xsl:value-of select="description_no"/></td>
            <xsl:choose>
                <xsl:when test="title = $hamningsberg_vaer//weatherdata/location/name">
                    <td><xsl:value-of select="$hamningsberg_vaer//weatherdata/forecast/text/location/time[1]/body"/></td>
                </xsl:when>
                <xsl:when test="title = $nesseby_vaer//weatherdata/location/name">
                    <td><xsl:value-of select="$nesseby_vaer//weatherdata/forecast/text/location/time[2]/body"/></td>
                </xsl:when>
                <xsl:otherwise>
                    <td>:/</td>
                </xsl:otherwise>
            </xsl:choose>
        </tr>
    </xsl:template>

</xsl:stylesheet>