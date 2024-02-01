const productTypeSelect = document.getElementById("productType");
const dvdDiv = document.getElementById("DVD");
const furnitureDiv = document.getElementById("Furniture");
const bookDiv = document.getElementById("Book");
const form = document.getElementById("product_form");
// Add event listener to the select element

function show() {
  // Show the selected div
  dvdDiv.classList.add("hidden");
  furnitureDiv.classList.add("hidden");
  bookDiv.classList.add("hidden");
  dvdDiv.classList.remove("flex");
  furnitureDiv.classList.remove("flex");
  bookDiv.classList.remove("flex");

  const selectedDivId = productTypeSelect.value;
  const selectedDiv = document.getElementById(selectedDivId);
  selectedDiv.classList.remove("hidden");
  selectedDiv.classList.add("flex");
}
let skuInput = document.getElementById("sku");
let nameInput = document.getElementById("name");
let priceInput = document.getElementById("price");
let skuError = document.getElementById("sku_error");
let nameError = document.getElementById("name_error");
let priceError = document.getElementById("price_error");
let typeError = document.getElementById("type_error");
let regexPrice = new RegExp(/^[1-9]\d*(\.\d{1,2})?$/);
let regexSku = new RegExp(/^[a-zA-Z0-9]+$/);
let regexName = new RegExp(/^[a-zA-Z0-9\s]+$/);
let regexAttributes = new RegExp(/^\d+$/);

function trim(str) {
  return str.trim();
}

function validateSku() {
  if (trim(skuInput.value) === "") {
    skuError.classList.remove("hidden");
    skuError.innerHTML = "Please, enter sku!";
    return false;
  } else if (!regexSku.test(skuInput.value)) {
    skuError.classList.remove("hidden");
    skuError.innerHTML = "Please, provide the data of indicated type!";
    return false;
  } else {
    skuError.classList.add("hidden");
    return true;
  }
}

function validateName() {
  if (trim(nameInput.value) === "") {
    nameError.classList.remove("hidden");
    nameError.innerHTML = "Please, provide a name!";
    return false;
  } else if (!regexName.test(nameInput.value)) {
    nameError.classList.remove("hidden");
    nameError.innerHTML = "Please, provide the data of indicated type!";
    return false;
  } else {
    nameError.classList.add("hidden");
    return true;
  }
}

function validatePrice() {
  let trimmedPrice = priceInput.value.trim();

  if (trim(priceInput.value) === "") {
    priceError.classList.remove("hidden");
    priceError.innerHTML = "Please, provide a price!";
    return false;
  } else if (!regexPrice.test(trimmedPrice)) {
    priceError.classList.remove("hidden");
    priceError.innerHTML = "Please, provide the data of indicated type!";
    return false;
  } else {
    priceError.classList.add("hidden");
    return true;
  }
}

function validateType() {
  if (productTypeSelect.value === "Select type") {
    typeError.classList.remove("hidden");
    typeError.innerHTML = "Please, provide a type of product!";
    return false;
  } else {
    typeError.classList.add("hidden");
    return true;
  }
}

function validateAttributes() {
  let selectedType = productTypeSelect.value;
  let typeToValidate = document.getElementById(selectedType);
  if (!typeToValidate) {
    return false;
  }

  let inputs = typeToValidate.querySelectorAll("input");
  isValid = true;

  for (let input of inputs) {
    let inputId = input.id;
    let getInputError = inputId + "_error";
    let inputError = document.getElementById(getInputError);

    if (input.value.trim() === "") {
      inputError.classList.remove("hidden");
      inputError.innerHTML = "Please, provide a valid " + inputId;
      isValid = false;
    } else if (!regexAttributes.test(input.value)) {
      inputError.classList.remove("hidden");
      inputError.innerHTML = "Please, provide the data of indicated type!";
      isValid = false;
    } else {
      inputError.classList.add("hidden");
    }
  }
  return isValid;
}

function validation() {
  let isSkuValid = validateSku();
  let isNameValid = validateName();
  let isPriceValid = validatePrice();
  let isTypeValid = validateType();
  let areAttributesValid = validateAttributes();

  return (
    isSkuValid &&
    isNameValid &&
    isPriceValid &&
    isTypeValid &&
    areAttributesValid
  );
}

let saveButton = document.getElementById("save-form-btn");
if (saveButton) {
  saveButton.addEventListener("click", (e) => {
    e.preventDefault();
    let isValid = validation();
    if (isValid) {
      form.submit();
    }
  });
}
let deleteButton = document.getElementById("delete-product-btn");
let deleteForm = document.getElementById("delete-product-form");
if (deleteButton) {
  deleteButton.addEventListener("click", (e) => {
    if (!isAnyCheckboxChecked()) {
      e.preventDefault();
    } else {
      deleteForm.submit();
    }
  });
}

function isAnyCheckboxChecked() {
  let checkboxes = document.querySelectorAll('input[name="product_delete[]"]');
  for (let checkbox of checkboxes) {
    if (checkbox.checked) {
      return true;
    }
  }
  return false;
}
