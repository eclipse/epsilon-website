var config = {
    settings: {
        showPopoutIcon: false,
        showMaximiseIcon: true,
        showCloseIcon: false
    },
    dimensions: {
            headerHeight: 32
        },
    content: [{
        type: 'row',
      content:[{
        type: 'column',
        width: 50,
        content:[{
              type: 'component',
              componentName: 'testComponent',
              title:'Program (EOL)',
              isClosable: false,
              componentState: { icon: 'eol.gif' }
          },{
              type: 'component',
              componentName: 'testComponent',
              title:'Console',
              isClosable: false,
              componentState: { icon: 'console.gif' }
          }]
      },{
            type: 'column',
            content:[{
                type: 'component',
                componentName: 'testComponent',
                title: 'Model (Flexmi)',
                isClosable: false,
                componentState: { icon: 'flexmi.png' }
            },{
                type: 'component',
                componentName: 'testComponent',
                title: 'Metamodel (Emfatic)',
                componentState: { icon: 'emfatic.png' },
                isClosable: false
            }]
        }]
    }]
};

var myLayout = new GoldenLayout( config );

myLayout.registerComponent( 'testComponent', function(container, state){
    container.on( 'tab', function( tab ){
        tab.element.prepend( $( '<img class="lm_tab_icon" src="../images/' + state.icon + '">' ) );
    });
});

myLayout.init();