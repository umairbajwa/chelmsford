var controller = new IdealPostcodes.Autocomplete.Controller({
    api_key: "ak_kt0bw1iyZ0G9Wlyek7itgZw8Xh7gQ",
    inputField: "#InformationAddress1",
    outputFields: {
        line_1: "#InformationAddress1",
        line_2: "#InformationAddress2",
        county: "#AddressTown",
        post_town: "#InformationAddress3",
        postcode: "#InformationPostcode"
    },
    onAddressPopulated: function (address) {
        console.log('event',address);
        // $(document).find("input.d-none.info-field-2").removeClass('d-none');
    }
});
