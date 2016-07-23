/**
 * Created by geraud on 22/02/2016.
 */
var context = require.context('./src', true, /-test\.js$/);
context.keys().forEach(context);