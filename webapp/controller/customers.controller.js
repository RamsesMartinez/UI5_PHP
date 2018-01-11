/* global app:true */
sap.ui.define([
  "sap/ui/core/mvc/Controller"
], function(Controller) {
  "use strict";

  return Controller.extend("UI5_PHP.controller.customers", {
    onInit: function() {
      sap.ui.localResources('i18n');

      var oResourceModel = new sap.ui.model.resource.ResourceModel({
        bundleName: "i18n.i18n"
      });

      sap.ui.getCore().setModel(oResourceModel, "i18n");

      var oModel = new sap.ui.model.json.JSONModel();
      var app = this;

      $.ajax({
        method: "POST",
        url: 'http://localhost/UI5_PHP/customers.php',
        async: false,

        // On receive of reply
        success: function(oData) {
          var jsonResult = JSON.parse(oData);

          if (jsonResult.code !== 0) {
            console.log(oData);
            return;
          }
          oModel.setData(jsonResult);
          app.getView().byId('customers-table').setModel(oModel);
        },
        error: function(err) {
          console.log("Error");
          console.log(err);
        }
      });
    }
  });
});