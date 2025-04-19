
    function openReturnUpdatePopup(returnData) {
        document.getElementById('return_id').value = returnData.return_id;
        document.getElementById('order_id').value = returnData.order_id;
        document.getElementById('product_id').value = returnData.product_id;
        document.getElementById('customer_id').value = returnData.customer_id;
        document.getElementById('customerName').value = returnData.customerName;
        document.getElementById('productName').value = returnData.productName;
        document.getElementById('quantity').value = returnData.quantity;
        document.getElementById('total').value = returnData.total;
        document.getElementById('orderDate').value = returnData.orderDate;
        document.getElementById('returnDetails').value = returnData.returnDetails;
        document.getElementById('cus_requirements').value = returnData.cus_requirements;
        document.getElementById('phone').value = returnData.phone;
        document.getElementById('return_status').value = returnData.returnStatus;


        document.getElementById('returnUpdatePopup').style.display = 'flex';

        // Add event listener to close the popup
      document.getElementById('closePopupBtn').addEventListener('click', () => {
        document.getElementById('returnUpdatePopup').style.display = 'none';
      });
    }
