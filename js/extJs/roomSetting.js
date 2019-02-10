


 Ext.onReady(function () {


    var SamplePanel = Ext.extend(Ext.Panel, { // Creating Panel to for Menu bar 
        width: 1365,
        height: 700,
        hidden: false,
        renderTo: 'menuBar',
       scrollable: true
    })

   
    new SamplePanel({ 
       title: 'Room Setting',
       tbar: [

        {
            xtype: 'button',
            text: 'Floor Create',
            listeners: {
                click: function() {
                  
                    var formPanel =  {
                        xtype       : 'form',
                        height      : 125,
                        autoScroll  : true,
                        id          : 'formpanel',
                        defaultType : 'field',
                        frame       : true,
                        title       : 'form panel',
                        items       : [
                            {
                                fieldLabel : 'Name'
                            },
                            {
                                fieldLabel : 'Age'
                            }
                        ]
                    };
                    
                    var myWin = new Ext.Window({
                        id     : 'myWin',
                        height : 400,
                        width  : 400,
                        layout: {
                            type: 'card',
                            padding_top: 5 
                        },
                        items: [{
                            xtype: 'form',
                            items: [{
                                xtype: 'textfield',
                                fieldLabel: 'Age',
                                name: 'age'
                            },{
                                xtype: 'textfield',
                                fieldLabel: 'Height',
                                name: 'height'
                            }],
                            fbar: [{
                                text: 'Submit',
                                formBind: true,
                                itemId: 'submit'
                            }]
                         }]
                    });
                    
                    myWin.show();

                }
             }
            
       }, {
            xtype: 'button',
            style: 'display:inline-block;background:#A2C841;padding:7px;cursor:pointer;',
            text: 'Room Create',
            listeners: {
               
                click: function() {
                   
                   loginwin.show();
                }
            }
       }
           
     /*   {                                   
           iconCls: 'add16',          
           text: 'test1',
           menu: [                    
                    {
                        
                        text: 'Register',
                        closable: false,
                        listeners: {
                            click: function () { 
                                 Registwin.show();
                            }
                        }
                    },
                        {
                          
                            text:'login',
                           closable: false,
                           listeners: {
                                click: function () {
                                   loginwin.show();
                                }
                            }
                        }
                    ]
                },
        {
            iconCls: 'add16',
            text: 'test2',
            menu: [
                   {
                      
                       text: "Register",
                       closable:false,
                       listeners: {
                           click:function () {
                              Registwin.show();
        
       }
                       }
                   },
                       {
                          
                           text:'login',
                           closable:false,
                          listeners: {
                              click: function () {
                                  loginwin.show();
                               }
        
       }
                       }
            ]

        },
          {
              iconCls: 'add16',
              text: 'test3',
              menu: [
                   {
                      
                       text: "Register",
                       closable: false,
                       listeners: {
                           click:function () {
                              Registwin.show();
                           }
                       }
                   },
                       {
                          
                           text:"login",
                           closable: false,
                          listeners: {
                              click: function () {
                                   loginwin.show();
                               }
                           }
                       }
              ]
          },
           {
               iconCls: 'add16',
               text: 'test4',
               menu: [
                   {
                     
                       text: "Register",
                       closable: false,
                       listeners: {
                           click:function () {
                              Registwin.show();
                           }
                       }
                   },
                       {
                          
                           text: "login",
                           closable: false,
         
                    listeners: {
                              click: function () {
                                  loginwin.show();
                               }
                           }
                       }
               ]
           },
            {
                 iconCls: 'add16',
                 text: 'test5',
                 menu: [
                   {
                      
                       text: 'Register',
                       closable: false,
                       listeners: {
                           click: function () {
                              Registwin.show();
                           }
                       }
                   },
                       {
                        
                           text: 'login',
                           closable: false,
                          listeners: {
                               click: function () {
                                   loginwin.show();
                               }
                           }
                       }
                 ]
            },
            {
        
 iconCls: 'add16',
                     text: 'test6',
                     menu: [
                       {
                         
                           text: 'Register',
                           closable: true,
                           listeners: {
                              click: function () {
                                  Registwin.show();
            
       }
                           }
                       },
                           {
                               
                               text: 'login',
                               closable: false,
                              listeners: {
                                  click: function () {
                                      loginwin.show();
               
        }
                               }
                           }
                     ]
            }, */
           
       ],
        
    })

});



/*Ext.onReady(function(){


    Ext.create('Ext.Button', {

       renderTo: Ext.getElementById('btnFloorCreate'),
       text: 'Floor Create',
       
       listeners: {
          click: function() {

             floorWindow();            
            
          }
       }
    });

    Ext.create('Ext.Button', {

        renderTo: Ext.getElementById('btnRoomCreate'),
        text: 'Room Create',
        
        listeners: {
           click: function() {
 
            windowWithHtml();            
             
           }
        }
     });






});  */



/*
Ext.onReady(function() {
    Ext.create('Ext.Panel', {
       renderTo: 'helloWorldPanel',
       height: 200,
       width: 600,
       title: 'Hello world',
       html: 'First Ext JS Hello World Program'
    });
 });*/


function createCustomForm(){

    var html="<div class='col-sm-12'>"
    
                +"<div class='col-sm-1'><label>User Name</label></div>"
                +"<div class='col-sm-3'><input class='form-control' /></div>"
    
            +"</div>";

        return html;

}


function windowWithHtml(){


var li="http://localhost/hotel_management/";

    Ext.create('Ext.window.Window', {
        title: 'Open other html file inside of window',
        height: 500,
        width: 500,
        layout: 'fit',
        items: [{
            xtype: "component",
            autoEl: {
                tag: "iframe",
                src: li
            }
        }]
    }).show();

     
           /* var win = Ext.create('Ext.window.Window', {
                title: 'Floor Create',
                closable: true,
                closeAction: 'hide',
                width: 600,
                minWidth: 600,
                height: 400,
                animCollapse:false,
                border: false,
                modal: false,
                layout: {
                    type: 'border',
                    padding: 5
                },
                listeners: {
                    afterrender: function() {
                       var div = Ext.fly('status_list');
                       var htmlList = '<ul class="status">' + 
                           '<li>The INE is <span class="status_value">running</span></li>' + 
                           '<li><span class="status_value">1</span> user is logged in</li>' + 
                           '<li><span class="status_value">No</span> emulation is running</li>' + 
                            '</ul>';
     
                       div.update(htmlList);
                   }
                }   
            }).show();*/
       
  

}


function getDiv(){


    var html="<div class='col-sm-12' id='status_list'></div>";

    return html;

}


function floorWindow(){




    /*

        Ext.create('Ext.tab.Panel', {
    items: [{
        title: 'Home',
        iconCls: 'home',
        html: 'Home Screen'
    }, {
        title: 'Contact',
        iconCls: 'user',
        html: 'Contact Screen'
    }],
    listeners: {
        painted: function () {
            alert('asd');
        }
    },
    renderTo: document.body
});


    */



    var w = new Ext.Window({
        width:700,
        autoHeight:true,
        title:'test',
        closeAction:'hide',
        modal:false,
        layout:'auto',
        html: getDiv(),
        
        defaults: {anchor: '95%'},
            listeners: {


                afterrender: function ( cmp ) {
                    var div = Ext.fly('status_list');
                       var htmlList = '<ul class="status">' + 
                           '<li>The INE is <span class="status_value">running</span></li>' + 
                           '<li><span class="status_value">1</span> user is logged in</li>' + 
                           '<li><span class="status_value">No</span> emulation is running</li>' + 
                            '</ul>';
     
                       div.update(htmlList);
                },
                render: function() {
                    //alert('Render');
                }
            }  
       /* items:[{
            autoScroll:true,
            defaultType:'textfield',
            xtype:'form',
            items:[
                {fieldLabel: 'Test1'},
                {fieldLabel: 'Test2'},
                {fieldLabel: 'Test3'},
                {fieldLabel: 'Test1'},
                {fieldLabel: 'Test2'},
                {fieldLabel: 'Test3'},
                {fieldLabel: 'Test1'},
                {fieldLabel: 'Test2'},
                {fieldLabel: 'Test3'}
            ]
        }]*/
        }).show();
        (function(){w.center()}).defer(250);




   /* Ext.create('Ext.window.Window', {

        title: 'Floor Create',
        closable: true,
        closeAction: 'hide',
        width: 600,
        minWidth: 600,
        height: 400,
        animCollapse:false,
        border: false,
        modal: false,
        layout: {
            type: 'border',
            padding: 5
        },
            items: [{
            xtype: 'form',
            preventBodyReset: true,
            html: createCustomForm(),
           items: [{
                    id : 'txtFirstName',
                    xtype : 'combobox',
                    fieldLabel : 'Age',
                    width      : 320,
                    store: new Ext.data.ArrayStore({
                    fields: ['id','value'],
                    autoLoad:true,
                    data: [
                        ['1','Marathi'],
                        ['2','English']
                    ]
            }),
            valueField:'id',
            displayField:'value'
            },{
            xtype: "textfield",
            inputType: "text",
            anchor: "100%",
            fieldLabel: 'Username:',
                id: 'usernameID',
                value: "abc",
                name: "username"
            },],
            fbar: [{
            text: 'Submit',
            formBind: true,
            itemId: 'submit',
            listeners: {
                click: function() {

                    var name = Ext.getCmp('usernameID').getValue();
                    var namess =Ext.getCmp('usernameID').setValue(name+" abcd ");         
                    var cname =Ext.getCmp('txtFirstName').getValue();                
                    Ext.MessageBox.alert('Alert box', cname);

                    },
                    
                }
            }]
            }]
    }).show();*/

}