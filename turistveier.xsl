﻿<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>
    <xsl:template match="turistveg-attraksjoner">
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
                        <th>Longitude</th><th>Informasjon</th></tr>
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
            </tr>
    </xsl:template>

</xsl:stylesheet>