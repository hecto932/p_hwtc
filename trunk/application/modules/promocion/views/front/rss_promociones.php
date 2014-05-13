<?php echo '<?xml version="1.0" encoding="utf-8"?>'?>

<rss    version="2.0"
        xmlns:dc="http://purl.org/dc/elements/1.1/"
        xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
        xmlns:admin="http://webns.net/mvcb/"
        xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
        xmlns:content="http://purl.org/rss/1.0/modules/content/">

    <channel>
    	
        <!-- Elementos constantes -->
        <title><?php echo $titulo ?></title>
        
        <link><?php echo $feed_url; ?></link>

		<atom:link href="<?php echo $feed_url; ?>" rel="self" type="application/rss+xml" />
		
        <description><?php echo $page_description ?></description>
        
        <language>es-es</language>
		
		<pubDate><?php echo $pub_date; ?></pubDate>
		
		<sy:updateFrequency>1</sy:updateFrequency>
		
		<managingEditor><?php echo $creator_email; ?></managingEditor>
		
        <?php foreach($feeds as $promo): ?>

            <item>
                <title><?php echo $promo->nombre ?></title>

                <link><?php echo base_url().'promociones/'.$promo->url; ?></link>

                <description><![CDATA[<?php echo $promo->descripcion_ampliada; ?>]]></description>

                <pubDate><?php echo $promo->creado; ?></pubDate>
				
				<dc:creator><?php echo $autor_per_post; ?></dc:creator>
				
            </item>

        <?php endforeach; ?>

    </channel>
</rss>
<?php //die(); ?>