(function ($) {
    var popup = $('<div id="tmcepopup"></div>');
    var container = $('<div></div>');
    popup.append(container);
    $('body').append(popup);
    function contentclick(event)
    {        
        popup.dialog('close');
        event.data.ed.selection.setContent('[staffmember id="{0}"]'.format(event.data.id));
    }
    function showdialog(ed)
    {
        popup.dialog({
            width: $(window).width() * 0.7,
            height: $(window).height() * 0.7,
			title: 'Add a Staffmember',
            modal: true,
            open: function(event, ui) {
                $(event.target).dialog('widget')
                    .css({ position: 'fixed' })
                    .position({ my: 'center', at: 'center', of: window });                    
                var params = {
                        action : 'action_shortcode_staffmember'
                    }
                jQuery.post(
                    ajaxurl,
                    params,
                    function (response) {
                        if (response) {    
                            var staff = $.parseJSON(response);
                            var table = $('<table><tr><th>Id</th><th>Thumbnail</th><th>Position</th><th>Title</th><th>Date</th></tr></table>');
                            var tbody = $('<tbody></tbody>');
                            for (var i = 0; i < staff.length; i++)
                            {
                                var row = $('<tr><td>{0}</td><td>{1}</td><td>{2}</td><td>{3}</td><td>{4}</td></tr>'.format(staff[i]['id'], staff[i]['thumbnail'], staff[i]['position'], staff[i]['title'], staff[i]['date']));
                                row.click({ed: ed, id: staff[i]['id']}, contentclick);
                                tbody.append(row);
                            }                             
                            table.append(tbody);
                            container.html(table);
                        } else
                        {
                            container.html('Error: Connection failed!');
                        }
                    }
                );
            }                
        });   
    }
    
    tinymce.create('tinymce.plugins.staffmember', {
        init : function(ed, url) {                  
            ed.addButton('staffmember', {              
                title : 'Add a Staffmember',  
                image : url+'/button-staffmember.png',  
                onclick : function() {  
                    container.html($('<img src="' + url + '/loading.gif' + '" />'));
                    showdialog(ed);
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('staffmember', tinymce.plugins.staffmember);  
}(jQuery));

(function ($) {
    var popup = $('<div id="tmcepopup"></div>');
    var container = $('<div></div>');
    popup.append(container);
    $('body').append(popup);
    function contentclick(event)
    {
        popup.dialog('close');
		console.log( event.data.boxstyle );
		
		if( (event.data.boxstyle)=='topicon' ){
			event.data.ed.selection.setContent('[service id="{0}" style="topicon"]'.format(event.data.id));
		} else {
			event.data.ed.selection.setContent('[service id="{0}"]'.format(event.data.id));
		}
        
    }
    function showdialog(ed)
    {
        popup.dialog({
            width: $(window).width() * 0.7,
            height: $(window).height() * 0.7,
            modal: true,
			title: 'Add a Service',
            open: function(event, ui) {
                $(event.target).dialog('widget')
                    .css({ position: 'fixed' })
                    .position({ my: 'center', at: 'center', of: window });                    
                var params = {
                        action : 'action_shortcode_service'
                    }
                jQuery.post(
                    ajaxurl,
                    params,
                    function (response) {
                        if (response) {
                            var service = $.parseJSON(response);
                            var table = $('<table><tr><th>Id</th><th>Icon</th><th>Title</th><th>Box Style</th><th>Date</th></tr></table>');
                            var tbody = $('<tbody></tbody>');
                            for (var i = 0; i < service.length; i++)
                            {
                                var row = $('<tr><td>{0}</td><td>{1}</td><td>{2}</td> <td><a href="#" class="">Left Icon</a> &nbsp; <a href="#" class="topicon">Top icon</a> </td> <td>{3}</td></tr>'.format(service[i]['id'], service[i]['icon'], service[i]['title'], service[i]['date']));
                                $('a',row).each(function(){
									$(this).click({ed: ed, id: service[i]['id'], boxstyle: $(this).attr('class') }, contentclick);
								});
								
                                tbody.append(row);
                            }                             
                            table.append(tbody);
                            container.html(table);
                        } else
                        {
                            container.html('Error: Connection failed!');
                        }
                    }
                );
            }                
        });   
    }
    
    tinymce.create('tinymce.plugins.service', {         
        init : function(ed, url) {                  
            ed.addButton('service', {
                title : 'Add a Service',
                image : url+'/button-service.png',
                onclick : function() {
					//console.log(ed);
                    container.html($('<img src="' + url + '/loading.gif' + '" />'));
                    showdialog(ed);
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });  
    tinymce.PluginManager.add('service', tinymce.plugins.service);  
}(jQuery));

(function ($) {
    var popup = $('<div id="tmcepopup"></div>');
    var container = $('<div></div>');
    popup.append(container);
    $('body').append(popup);
    function showdialog(ed)
    {
        popup.dialog({
            width: $(window).width() * 0.7,
            height: $(window).height() * 0.7,
			title : 'Add a Price Table',
            modal: true,
            open: function(event, ui) {
                $(event.target).dialog('widget')
                    .css({ position: 'fixed' })
                    .position({ my: 'center', at: 'center', of: window });                    
                var params = {
                        action : 'action_shortcode_pricetable'
                    }
                jQuery.post(
                    ajaxurl,
                    params,
                    function (response) {
                        if (response) {                                
                            container.html('');
                            var pricetables = $.parseJSON(response);                            
                            var tablestyle = $('Price Table slyle <select><option value="extended" selected="selected">Extended</option><option value="simple">Simple</option></select>')
                            container.append(tablestyle);
                            var select = $('<select></select>')
                            for (var i = 0; i < pricetables.length; i++)
                            {
                                var option = $('<option />');
                                option.val(JSON.stringify(pricetables[i]));
                                option.text('({0}) {1} ({2})'.format(pricetables[i]['id'], pricetables[i]['title'], pricetables[i]['date']));
                                select.append(option);
                            }                                                                             
                            container.append(select);
                            var btn = $('<input type="button" value="Add" />');
                            container.append(btn);
                            var tbody = $('<tbody></tbody>');
                            var table = $('<table></table>');
                            var tableheader = $('<tr><th>Type</th><th>Title</th></tr>');
                            table.append(tableheader);
                            table.append(tbody);
                            btn.click(function(){
                                var pricetable = $.parseJSON(select.val());
                                var row = $('<tr><td><input type="hidden" value="{1}" /><select><option selected="selected" value=""></option><option value="labels">Labels</option><option value="starter">Starter</option><option value="popular">Popular</option></select></td><td><a href="#" class="delete-link">Remove</></td><td>{0}<td></tr>'.format(select.find('option:selected').text(), pricetable['id']));
                                row.find('a.delete-link').click(function(element){
                                    row.remove();                                    
                                    return false;
                                })
                                tbody.append(row);
                                return false;
                            });  
                            tbody.sortable({
                                cursor: 'move',
                                items: '> tr'
                            });
                            tbody.disableSelection();                                                      
                            container.append(table);
                            // add a button
                            var footer = $('<div></div>');
                            var addbtn = $('<input type="button" value="Add Shortcode" />');
                            addbtn.click(function(){
                                var items = '';
                                var count = 0;
                                tbody.find('tr').each(function()
                                {
                                    var element = $(this);
                                    items += '[priceitem id="{0}" style="{1}"]'.format(element.find('input[type=hidden]').val(), element.find('select').val());
                                    count++;
                                })                                
                                popup.dialog('close');  
                                ed.selection.setContent('[pricetable columns="{0}" type="{1}"]{2}[/pricetable]'.format(count, tablestyle.val(), items));
                                return false;
                            });
                            footer.append(addbtn);
                            container.append(footer);
                        } else
                        {
                            container.html('Error: Connection failed!');
                        }
                    }
                );
            }                
        });   
    }
    
    tinymce.create('tinymce.plugins.pricetable', {          
        init : function(ed, url) {                  
            ed.addButton('pricetable', {              
                title : 'Add a Price Table',  
                image : url+'/button-pricetable.png',  
                onclick : function() {  
                    container.html($('<img src="' + url + '/loading.gif' + '" />'));
                    showdialog(ed);
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('pricetable', tinymce.plugins.pricetable);  
}(jQuery));

(function($) {  
    tinymce.create('tinymce.plugins.accordion', {  
        init : function(ed, url) {  
            ed.addButton('accordion', {  
                title : 'Add an Accordion',  
                image : url+'/button-accordion.png',  
                onclick : function() {  
                     ed.selection.setContent('[accordion][accordionitem title="Title 1"] Item 1 Content[/accordionitem][accordionitem title="Title 2"] Item 2 Content[/accordionitem][/accordion]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('accordion', tinymce.plugins.accordion);  
}(jQuery));

(function($) {  
    tinymce.create('tinymce.plugins.tabs', {  
        init : function(ed, url) {  
            ed.addButton('tabs', {  
                title : 'Add a Tabs',  
                image : url+'/button-tabs.png',  
                onclick : function() {  
                     ed.selection.setContent('[tabs][tab title="Tab 1"]Tab 1 Content[/tab][tab title="Tab 2"]Tab 2 Content[/tab][/tabs]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('tabs', tinymce.plugins.tabs);  
}(jQuery));

(function($) {  
    tinymce.create('tinymce.plugins.button', {  
        init : function(ed, url) {  
            ed.addButton('button', {  
                title : 'Add a Button',  
                image : url+'/button-button.png',  
                onclick : function() {  
                     ed.selection.setContent('[button class="yellow" url="#" text="Click Me"]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('button', tinymce.plugins.button);  
}(jQuery));

(function($) {  
    tinymce.create('tinymce.plugins.col12', {  
        init : function(ed, url) {  
            ed.addButton('col12', {  
                title : 'Add a 1/2 Column',  
                image : url+'/button-col12.png',  
                onclick : function() {  
                     ed.selection.setContent('[column class="1/2"]Text inside the column[/column]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('col12', tinymce.plugins.col12);  
}(jQuery));

(function($) {  
    tinymce.create('tinymce.plugins.col13', {  
        init : function(ed, url) {  
            ed.addButton('col13', {  
                title : 'Add a 1/3 Column',  
                image : url+'/button-col13.png',  
                onclick : function() {  
                     ed.selection.setContent('[column class="1/3"]Text inside the column[/column]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('col13', tinymce.plugins.col13);  
}(jQuery));

(function($) {  
    tinymce.create('tinymce.plugins.col23', {  
        init : function(ed, url) {  
            ed.addButton('col23', {  
                title : 'Add a 2/3 Column',  
                image : url+'/button-col23.png',  
                onclick : function() {  
                     ed.selection.setContent('[column class="2/3"]Text inside the column[/column]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('col23', tinymce.plugins.col23);  
}(jQuery));

(function($) {  
    tinymce.create('tinymce.plugins.col14', {  
        init : function(ed, url) {  
            ed.addButton('col14', {  
                title : 'Add a 1/4 Column',  
                image : url+'/button-col14.png',  
                onclick : function() {  
                     ed.selection.setContent('[column class="1/4"]Text inside the column[/column]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('col14', tinymce.plugins.col14);  
}(jQuery));

(function($) {  
    tinymce.create('tinymce.plugins.col34', {  
        init : function(ed, url) {  
            ed.addButton('col34', {  
                title : 'Add a 3/4 Column',  
                image : url+'/button-col34.png',  
                onclick : function() {  
                     ed.selection.setContent('[column class="3/4"]Text inside the column[/column]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('col34', tinymce.plugins.col34);  
}(jQuery));

/*
(function($) {
    tinymce.create('tinymce.plugins.pagetitle', {  
        init : function(ed, url) {  
            ed.addButton('pagetitle', {  
                title : 'Add a Page Title',  
                image : url+'/button-pagetitle.png',  
                onclick : function() {  
                     ed.selection.setContent('[pagetitle]<br/>Above all, we believe&lt;br /&gt; &lt;span&gt;in quality design&lt;/span&gt;<br/>[/pagetitle]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('pagetitle', tinymce.plugins.pagetitle);  
}(jQuery));
*/

(function($) {  
    tinymce.create('tinymce.plugins.progress', {  
        init : function(ed, url) {  
            ed.addButton('progress', {  
                title : 'Add a Progress',  
                image : url+'/button-progress.png',  
                onclick : function() {  
                     ed.selection.setContent('[progress title="The Skills" percent="80"]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('progress', tinymce.plugins.progress);  
}(jQuery));

(function($) {
    tinymce.create('tinymce.plugins.sep', {
        init : function(ed, url) {  
            ed.addButton('sep', {  
                title : 'Add a Separator',  
                image : url+'/button-sep.png',  
                onclick : function() {  
                     ed.selection.setContent('[sep height="30"]');  
                }  
            });  
        },  
        createControl : function(n, cm) {
            return null;  
        },  
    });  
    tinymce.PluginManager.add('sep', tinymce.plugins.sep);  
}(jQuery));


// Infobox
(function($) {
    tinymce.create('tinymce.plugins.infobox', {
        init : function(ed, url) {  
            ed.addButton('infobox', {  
                title : 'Add Infobox',
                image : url+'/button-infobox.png',  
                onclick : function() {  
                     ed.selection.setContent('[infobox]Content will be here[/infobox]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('infobox', tinymce.plugins.infobox);  
}(jQuery));



(function ($) {
    var popup = $('<div id="tmcepopup"></div>');
    var container = $('<div></div>');
    popup.append(container);
    $('body').append(popup);
    function contentclick(event)
    {        
        popup.dialog('close');
        event.data.ed.selection.setContent('[logos id="{0}"]'.format(event.data.id));
    }
    function showdialog(ed)
    {
        popup.dialog({
            width: $(window).width() * 0.7,
            height: $(window).height() * 0.7,
			title : 'Add a Logos Box',
            modal: true,
            open: function(event, ui) {
                $(event.target).dialog('widget')
                    .css({ position: 'fixed' })
                    .position({ my: 'center', at: 'center', of: window });                    
                var params = {
                        action : 'action_shortcode_galleries'
                    }
                jQuery.post(
                    ajaxurl,
                    params,
                    function (response) {
                        if (response) {    
                            var gallery = $.parseJSON(response);
                            var table = $('<table><tr><th>Id</th><th>Title</th><th>Date</th></tr></table>');
                            var tbody = $('<tbody></tbody>');
                            for (var i = 0; i < gallery.length; i++)
                            {
                                var row = $('<tr><td>{0}</td><td>{1}</td><td>{2}</td></tr>'.format(gallery[i]['id'], gallery[i]['title'], gallery[i]['date']));
                                row.click({ed: ed, id: gallery[i]['id']}, contentclick);
                                tbody.append(row);
                            }                             
                            table.append(tbody);
                            container.html(table);
                        } else
                        {
                            container.html('Error: Connection failed!');
                        }
                    }
                );
            }                
        });   
    }
    
    tinymce.create('tinymce.plugins.logos', {          
        init : function(ed, url) {                  
            ed.addButton('logos', {              
                title : 'Add a Logos Box',  
                image : url+'/button-logos.png',  
                onclick : function() {  
                    container.html($('<img src="' + url + '/loading.gif' + '" />'));
                    showdialog(ed);
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('logos', tinymce.plugins.logos);  
}(jQuery));

(function($) {  
    tinymce.create('tinymce.plugins.googlemap', {  
        init : function(ed, url) {  
            ed.addButton('googlemap', {  
                title : 'Add a Google Map',  
                image : url+'/button-googlemap.png',  
                onclick : function() {  
                     ed.selection.setContent('[googlemap lat="0" lng="0" zoom="10" title="My Place"]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('googlemap', tinymce.plugins.googlemap);  
}(jQuery));

(function($) {  
    tinymce.create('tinymce.plugins.projects', {  
        init : function(ed, url) {  
            ed.addButton('projects', {  
                title : 'Add a Projects Carousel',  
                image : url+'/button-projects.png',  
                onclick : function() {  
                     ed.selection.setContent('[projects count="10"]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('projects', tinymce.plugins.projects);  
}(jQuery));

(function($) {  
    tinymce.create('tinymce.plugins.recentposts', {  
        init : function(ed, url) {  
            ed.addButton('recentposts', {  
                title : 'Add a Recent Posts',  
                image : url+'/button-recentposts.png',  
                onclick : function() {  
                     ed.selection.setContent('[recentposts count="4" columns="4" categories="" tags="" excerpt="80"]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('recentposts', tinymce.plugins.recentposts);  
}(jQuery));



(function ($) {
    var popup = $('<div id="tmcepopup"></div>');
    var container = $('<div></div>');
    popup.append(container);
    $('body').append(popup);
    function contentclick(event)
    {        
        popup.dialog('close');
        event.data.ed.selection.setContent('[slider gallery="{0}"]'.format(event.data.id));
    }
    function showdialog(ed)
    {
        popup.dialog({
            width: $(window).width() * 0.7,
            height: $(window).height() * 0.7,
			title: 'Add an Images Slider',
            modal: true,
            open: function(event, ui) {
                $(event.target).dialog('widget')
                    .css({ position: 'fixed' })
                    .position({ my: 'center', at: 'center', of: window });                    
                var params = {
                        action : 'action_shortcode_galleries'
                    }
                jQuery.post(
                    ajaxurl,
                    params,
                    function (response) {
                        if (response) {    
                            var gallery = $.parseJSON(response);
                            var table = $('<table><tr><th>Id</th><th>Title</th><th>Date</th></tr></table>');
                            var tbody = $('<tbody></tbody>');
                            for (var i = 0; i < gallery.length; i++)
                            {
                                var row = $('<tr><td>{0}</td><td>{1}</td><td>{2}</td></tr>'.format(gallery[i]['id'], gallery[i]['title'], gallery[i]['date']));
                                row.click({ed: ed, id: gallery[i]['id']}, contentclick);
                                tbody.append(row);
                            }                             
                            table.append(tbody);
                            container.html(table);
                        } else
                        {
                            container.html('Error: Connection failed!');
                        }
                    }
                );
            }                
        });   
    }
    
    tinymce.create('tinymce.plugins.imagesslider', {          
        init : function(ed, url) {                  
            ed.addButton('imagesslider', {              
                title : 'Add an Images Slider',  
                image : url+'/button-imagesslider.png',  
                onclick : function() {  
                    container.html($('<img src="' + url + '/loading.gif' + '" />'));
                    showdialog(ed);
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('imagesslider', tinymce.plugins.imagesslider);  
}(jQuery));

(function ($) {
    var popup = $('<div id="tmcepopup"></div>');
    var container = $('<div></div>');
    popup.append(container);
    $('body').append(popup);
    function contentclick(event)
    {        
        popup.dialog('close');
        event.data.ed.selection.setContent('[slider slides="{0}"]'.format(event.data.id));
    }
    
    
    function showdialog(ed)
    {
        popup.dialog({
            width: $(window).width() * 0.7,
            height: $(window).height() * 0.7,
            modal: true,
            open: function(event, ui) {
                $(event.target).dialog('widget')
                    .css({ position: 'fixed' })
                    .position({ my: 'center', at: 'center', of: window });                    
                var params = {
                        action : 'action_shortcode_slides'
                    }
                jQuery.post(
                    ajaxurl,
                    params,
                    function (response) {
                        if (response) {                                
                            container.html('');
                            var slides = $.parseJSON(response);                            
                            var select = $('<select></select>')
                            for (var i = 0; i < slides.length; i++)
                            {
                                var option = $('<option />');
                                option.val(JSON.stringify(slides[i]));
                                option.text('({0}) {1} ({2})'.format(slides[i]['id'], slides[i]['title'], slides[i]['date']));
                                select.append(option);
                            }                                                                             
                            container.append(select);
                            var btn = $('<input type="button" value="Add" />');
                            container.append(btn);
                            var tbody = $('<tbody></tbody>');
                            var table = $('<table></table>');
                            var tableheader = $('<tr><th></th><th>Id</th><th>Thumbnail</th><th>Title</th></tr>');
                            table.append(tableheader);
                            table.append(tbody);
                            btn.click(function(){
                                var slide = $.parseJSON(select.val());
                                var row = $('<tr><td><input type="hidden" value="{0}" /><a href="#" class="delete-link">Remove</></td><td>{1}</td><td>{2}</td></tr>'.format(slide['id'], slide['thumbnail'], slide['title']));
                                row.find('a.delete-link').click(function(element){
                                    row.remove();                                    
                                    return false;
                                })
                                tbody.append(row);
                                return false;
                            });  
                            tbody.sortable({
                                cursor: 'move',
                                items: '> tr'
                            });
                            tbody.disableSelection();                                                      
                            container.append(table);
                            // add a button
                            var footer = $('<div></div>');
                            var addbtn = $('<input type="button" value="Add Shortcode" />');
                            addbtn.click(function(){
                                var items = new Array();
                                tbody.find('tr').each(function()
                                {
                                    var element = $(this);
                                    items.push(element.find('input[type=hidden]').val());
                                })                                
                                popup.dialog('close');  
                                ed.selection.setContent('[slider slides="{0}"]'.format(items.join(',')));
                                return false;
                            });
                            footer.append(addbtn);
                            container.append(footer);
                        } else
                        {
                            container.html('Error: Connection failed!');
                        }
                    }
                );
            }                
        });   
    }    
    
    
    function showdialog111(ed)
    {
        popup.dialog({
            width: $(window).width() * 0.7,
            height: $(window).height() * 0.7,
			title: 'Add a Slides Slider',
            modal: true,
            open: function(event, ui) {
                $(event.target).dialog('widget')
                    .css({ position: 'fixed' })
                    .position({ my: 'center', at: 'center', of: window });                    
                var params = {
                        action : 'action_shortcode_slides'
                    }
                jQuery.post(
                    ajaxurl,
                    params,
                    function (response) {
                        if (response) {    
                            var slides = $.parseJSON(response);
                            var table = $('<table><tr><th>Id</th><th>Thumbnail</th><th>Title</th><th>Date</th></tr></table>');
                            var tbody = $('<tbody></tbody>');
                            for (var i = 0; i < slides.length; i++)
                            {
                                var row = $('<tr><td>{0}</td><td>{1}</td><td>{2}</td><td>{3}</td></tr>'.format(slides[i]['id'], slides[i]['thumbnail'], slides[i]['title'], slides[i]['date']));
                                row.click({ed: ed, id: slides[i]['id']}, contentclick);
                                tbody.append(row);
                            }                             
                            table.append(tbody);
                            container.html(table);
                        } else
                        {
                            container.html('Error: Connection failed!');
                        }
                    }
                );
            }                
        });   
    }
    
    tinymce.create('tinymce.plugins.slidesslider', {
        init : function(ed, url) {                  
            ed.addButton('slidesslider', {              
                title : 'Add a Slides Slider',  
                image : url+'/button-slidesslider.png',  
                onclick : function() {  
                    container.html($('<img src="' + url + '/loading.gif' + '" />'));
                    showdialog(ed);
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('slidesslider', tinymce.plugins.slidesslider);  
	
	
	tinymce.create('tinymce.plugins.calltoaction', {
        init : function(ed, url) {
            ed.addButton('calltoaction', {              
                title : 'Add a Call to Action Box',  
                image : url+'/button-calltoaction.png',  
                onclick : function() {  
					ed.selection.setContent('[calltoaction title="Überschrift" text="Zwei flinke Boxer jagen die quirlige Eva und ihren Mops durch Sylt." buttontext="Weiterlesen" buttonlink="#" image="'+url.replace('/include/js','')+'/img/body-bg.jpg"]');
                }  
            });  
        },  
        createControl : function(n, cm) {
            return null;  
        },  
    });  
    tinymce.PluginManager.add('calltoaction', tinymce.plugins.calltoaction);
	
	
	tinymce.create('tinymce.plugins.wrapper', {
        init : function(ed, url) {
            ed.addButton('wrapper', {              
                title : 'Add a Wrapper',
                image : url+'/button-wrapper.png',  
                onclick : function() {  
					ed.selection.setContent('[wrapper][/wrapper]');
                }  
            });  
        },  
        createControl : function(n, cm) {
            return null;  
        },  
    });  
    tinymce.PluginManager.add('wrapper', tinymce.plugins.wrapper);
	
	
}(jQuery));
