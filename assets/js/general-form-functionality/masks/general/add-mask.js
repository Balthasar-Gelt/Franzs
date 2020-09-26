import Inputmask from "inputmask";

export function addMask(maskString, input){

    Inputmask(maskString,{jitMasking: true, showMaskOnHover: false}).mask(input);
}