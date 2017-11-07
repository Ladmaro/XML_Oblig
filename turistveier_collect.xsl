<?xml version="1.0" encoding="UTF-8"?>

<!-- Skrevet av Adrian Rovelstad -->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">

    <xsl:param name="hamningsberg_vaer"
               select="document('http://www.yr.no/sted/Norge/Finnmark/B%C3%A5tsfjord/Hamningberg/varsel.xml')"/>
    <xsl:param name="steilnesset_vaer"
               select="document('http://www.yr.no/sted/Norge/Finnmark/Vard%C3%B8/Steglneset/varsel.xml')"/>
    <xsl:param name="nesseby_vaer"
               select="document('http://www.yr.no/sted/Norge/Finnmark/Nesseby/Nesseby~2324746/varsel.xml')"/>
    <xsl:param name="gornitak_vaer"
               select="document('https://www.yr.no/sted/Norge/Finnmark/Nesseby/Gornitak/varsel.xml')"/>
    <xsl:param name="birding_vaer"
               select="document('https://www.yr.no/sted/Norge/Finnmark/Vads%C3%B8/Vads%C3%B8/varsel.xml')"/>

    <xsl:output method="xml" indent="yes"/>

    <xsl:template match="turistveg-attraksjon">
        <turistveg_attraksjon>
            <Sted>
                <xsl:value-of select="title"/>
            </Sted>
            <Varsel>
                <xsl:choose>
                    <xsl:when test="title = $hamningsberg_vaer//weatherdata/location/name">

                        <xsl:for-each select="$hamningsberg_vaer//weatherdata/forecast/text/location/time">
                            <forecast>
                                <dato>
                                    <xsl:value-of
                                            select="@from"/></dato>
                                <title><xsl:value-of select="title"/></title>
                                <body><xsl:value-of select="body"/></body>
                            </forecast>
                        </xsl:for-each>

                    </xsl:when>
                    <xsl:when test="title = $steilnesset_vaer//weatherdata/location/name">

                        <xsl:for-each select="$steilnesset_vaer//weatherdata/forecast/text/location/time">
                            <forecast>
                                <dato>
                                    <xsl:value-of
                                            select="@from"/></dato>
                                <title><xsl:value-of select="title"/></title>
                                <body><xsl:value-of select="body"/></body>
                            </forecast>
                        </xsl:for-each>

                    </xsl:when>
                    <xsl:when test="title = $nesseby_vaer//weatherdata/location/name">

                        <xsl:for-each select="$nesseby_vaer//weatherdata/forecast/text/location/time">
                            <forecast>
                                <dato>
                                    <xsl:value-of
                                            select="@from"/></dato>
                                <title><xsl:value-of select="title"/></title>
                                <body><xsl:value-of select="body"/></body>
                            </forecast>
                        </xsl:for-each>

                    </xsl:when>
                    <xsl:when test="title = $gornitak_vaer//weatherdata/location/name">

                        <xsl:for-each select="$gornitak_vaer//weatherdata/forecast/text/location/time">
                            <forecast>
                                <dato>
                                    <xsl:value-of
                                            select="@from"/></dato>
                                <title><xsl:value-of select="title"/></title>
                                <body><xsl:value-of select="body"/></body>
                            </forecast>
                        </xsl:for-each>

                    </xsl:when>
                    <xsl:when test="title = $birding_vaer//weatherdata/location/name">

                        <xsl:for-each select="$birding_vaer//weatherdata/forecast/text/location/time">
                            <forecast>
                                <dato>
                                    <xsl:value-of
                                            select="@from"/></dato>
                                <title><xsl:value-of select="title"/></title>
                                <body><xsl:value-of select="body"/></body>
                            </forecast>
                        </xsl:for-each>

                    </xsl:when>

                </xsl:choose>
            </Varsel>
            <Latitude>
                <xsl:value-of select="latitude"/>
            </Latitude>
            <Longitude>
                <xsl:value-of select="longitude"/>
            </Longitude>
            <Informasjon>
                <xsl:value-of select="description_no"/>
            </Informasjon>


        </turistveg_attraksjon>
    </xsl:template>

    <xsl:template match="@* | node()">
        <xsl:copy>
            <xsl:apply-templates select="@* | node()"/>
        </xsl:copy>
    </xsl:template>


</xsl:stylesheet>