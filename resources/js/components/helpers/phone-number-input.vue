<template>
    <transition name="fade">
        <div class="w-100 m-0 p-0">
            <vue-phone-number-input v-model="phoneNumber"
                                    @update="onUpdatePhoneInput($event)"
                                    :default-country-code="defaultCountryCode"
                                    :only-countries="only_countries"
                                    color="#f44336"
                                    valid-color="#4CAF50"
                                    :translations="translations"
            />
            <span id="span-error-valid"
                  class="color-red mfs-08"
                  style="display: none;">{{ locale['error_valid_phone_number'] }}
            </span>
            <input id="is-valid-phone-number"
                   type="hidden"
                   v-model="isValidNumber">
            <input type="hidden"
                   name="mobilePhone"
                   v-model="full_phone_number">
        </div>
    </transition>
</template>

<script>
    import 'vue-phone-number-input/dist/vue-phone-number-input.css';

    export default {
        name: "phone-number-input",
        props:['setLocale'],
        data() {
            return {
                only_countries      : ['PL'],
                full_phone_number   : '',
                countryCallingCode  : '48',
                phoneNumber         : '',
                defaultCountryCode  : 'PL',
                isValidNumber       : false,
                locale              : [],

                translations: {
                    countrySelectorLabel    : 'Country code',
                    countrySelectorError    : 'Choose a country',
                    phoneNumberLabel        : 'Phone number',
                    example                 : 'Example :'
                }
            }
        },
        created() {
            this.locale = JSON.parse(this.setLocale);
            this.translations = {
                countrySelectorLabel    : this.locale['Country code'],
                countrySelectorError    : this.locale['Choose a country'],
                phoneNumberLabel        : this.locale['Phone number'],
                example                 : this.locale['Exemple :']
            };
        },
        methods:{
            onUpdatePhoneInput(data){
                this.countryCallingCode = data.countryCallingCode;
                this.full_phone_number  = data.countryCallingCode + data.phoneNumber;

                var span_error_valid    = $('#span-error-valid');
                this.isValidNumber      = data.isValid;

                if(this.phoneNumber.length > 0) {
                    if (data.isValid === true) {
                        span_error_valid.hide();
                    } else {
                        span_error_valid.show();
                    }
                } else {
                    span_error_valid.hide();
                }
            }
        }
    }
</script>

<style scoped>

</style>
