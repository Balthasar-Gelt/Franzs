export function getAlert(form, errorType){

    const formId = form.id;

    const childClass = ('.' + errorType + '_alert');

    return document.querySelector('#' + formId + ' ' + childClass);
}