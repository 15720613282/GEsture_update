require.config({
    //baseUrl: 'GeneNetwork/public/js/echarts',
    paths: {
        /*'geoJson': '../geoData/geoJson',
        'theme': '../theme',
        'data': './data',
        'map': '../map',
        'extension': '../extension'*/
    },
    packages: [
        {
            main: 'echarts',
            location: 'GeneNetwork/public/js/echarts',
            name: 'echarts'
        },
        {
            main: 'zrender',
            location: '../../zrender/src',
            name: 'zrender'
        }
    ]
    // urlArgs: '_v_=' + +new Date()
});