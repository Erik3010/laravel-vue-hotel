<template>
    <div>
        <h4>Credit Card</h4>
        <div class="form-group">
            <label class="control-label">Card Number</label>
            <input 
                type="number" 
                class="form-control" 
                placeholder="16 digit card number"
                :disabled="disabled"
                v-model="data.payment.card_number"
                >
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <label class="control-label">Name on card:</label>
                <input 
                    type="text" 
                    class="form-control"
                    :disabled="disabled"
                    v-model="data.payment.name_on_card"
                    >
            </div>
        <div class="col-sm-2">
            <label class="control-label">CCV Code:</label>
            <input 
                type="number" 
                maxlength="3" 
                class="form-control" 
                placeholder="3 digit CCV"
                :disabled="disabled"
                v-model="data.payment.ccv_code"
                >
        </div>   
    </div>
</template>