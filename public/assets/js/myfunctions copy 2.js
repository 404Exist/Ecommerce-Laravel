// Delete Data ----------------------------------------------
function toggleCheckAll(clickedInput, classToCheck) {
    document.querySelectorAll("." + classToCheck).forEach((input) => {
        input.checked = clickedInput.checked ? true : false;
    });
}

function delete_admin_modal_ui(
    admin_id = "",
    admin_name,
    check_class = "check_admins",
    deleteForm = "deleteAdminsForm"
) {
    if (admin_id == "") {
        let checkedInputsConut = document.querySelectorAll(
            "." + check_class + ":checked"
        ).length;
        document.querySelector("#multipleDelete .modal-body .alert").innerHTML =
            checkedInputsConut > 0
                ? `<h4> Are you sure you want to delete ${checkedInputsConut} record ?</h4>`
                : "<h4> Please, select any records to delete.</h4>";

        multipleDelete__submit.innerHTML =
            checkedInputsConut > 0
                ? `<input type="submit" name="del_all" value="Delete" class="btn btn-danger" onClick="document.getElementById('${deleteForm}').submit()"/>`
                : "";
    } else {
        document.querySelectorAll("." + check_class).forEach((input) => {
            input.checked = input.value == admin_id ? true : false;
        });
        document.querySelector(
            "#multipleDelete .modal-body .alert"
        ).innerHTML = `<h4> Are you sure you want to delete ${admin_name} ?</h4>`;
        multipleDelete__submit.innerHTML = `<input type="submit" value="Delete" class="btn btn-danger" onClick="document.getElementById('${deleteForm}').submit()"/>`;
    }
}

// Ajax-------------------------------------------------------
function ajax(data = []) {
    data["type"] = "type" in data ? data["type"] : "GET";
    data["data"] = "data" in data ? data["data"] : "";
    data["contentType"] = "contentType" in data ? data["contentType"] : true;
    data["dataType"] = "dataType" in data ? data["dataType"] : "xhtml+xml";

    data["success"] =
        "success" in data
            ? data["success"]
            : function (res) {
                  ajaxResponse.innerHTML = res.responseText;
              };
    var body = data["data"],
        params = "";

    if (typeof data["data"] === "object" && data["contentType"]) {
        for (key in data["data"]) {
            params += key + "=" + data["data"][key] + "&";
        }
        body = params !== "" ? params.substring(0, params.length - 1) : "";
    }
    "beforeSend" in data ? data["beforeSend"]() : "";
    const ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status === 200) data["success"](this);
            else "error" in data ? data["error"](this) : "";
        }
    };
    ajax.open(data["type"], data["url"], true);
    ajax.setRequestHeader(
        "X-CSRF-TOKEN",
        document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content") ?? "{{ csrf_token() }}"
    );
    ajax.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    data["contentType"]
        ? ajax.setRequestHeader(
              "Content-Type",
              "application/x-www-form-urlencoded"
          )
        : "";
    ajax.setRequestHeader("Accept", `application/${data["dataType"]}`);
    ajax.send(body);
}

// Product CRUD ----------------------------------------------
function productCrud(e, type, url, data = "", contentType = true) {
    validation.className = "alert d-none mt-4";
    let icon = e.children[0];
    let formData = new FormData(product_form);
    data = data === "" ? formData : data;
    ajax({
        type,
        url,
        data,
        contentType,
        dataType: "json",
        success: function (data) {
            validation.classList.add("alert-success");
            validation.classList.remove("d-none");
            validation.children[0].innerHTML = `<h4 style="margin: 0;">${
                JSON.parse(data.response).message
            }</h4>`;
            icon.innerHTML = '<i class="fa fa-save"></i>';
            setTimeout(() => {
                type.toLowerCase() == "delete"
                    ? (window.location.href = "/admin/products")
                    : "";
            }, 500);
        },
        beforeSend: function () {
            icon.innerHTML = '<i class="fa fa-spin fa-spinner"></i>';
        },
        error: function (res) {
            let response = res.responseJSON || JSON.parse(res.response);
            icon.innerHTML = '<i class="fa fa-spin fa-spinner"></i>';
            let errors = "";
            $.each(response.errors, function (i, value) {
                errors += `
						<li>${value}</li>
					`;
            });

            validation.classList.add("alert-danger");
            validation.classList.remove("d-none");
            validation.children[0].innerHTML = errors;
        },
    });
}

// Drop Zone -------------------------------------------------
var fileStore = [],
    formFiles,
    newestFiles = [],
    pushFiles = true
    errorMsgs = [];

function deleteFile(el, lastModified, fileID, onDeleteFun) {
    if (confirm("Are you sure you want to remove this image ?")) {
        fileStore = fileStore.filter(
            (file) => file.lastModified != lastModified
        );
        if (fileID) {
            let removedFilesInput = document.createElement("input");
            removedFilesInput.setAttribute("type", "hidden");
            removedFilesInput.setAttribute("name", "removedFilesID[]");
            removedFilesInput.setAttribute("value", fileID);
            drop_zone.prepend(removedFilesInput);
            if (onDeleteFun) {
                drop_zone_input.files = new FileListItems(fileStore);
                onDeleteFun(fileID, drop_zone_input.files);
            }
        } else {
            if (onDeleteFun) {
                drop_zone_input.files = new FileListItems(fileStore);
                onDeleteFun(null, drop_zone_input.files);
            }
        }

        el.parentElement.remove();
    }
}

function formatBytes(bytes, decimals = 2) {
    if (bytes === 0) return '0 Bytes';
    let sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
        i = Math.floor(Math.log(bytes) / Math.log(1024));
    return parseFloat((bytes / Math.pow(1024, i)).toFixed(decimals)) + ' ' + sizes[i];
}

function FileListItems(files) {
    var b = new ClipboardEvent("").clipboardData || new DataTransfer();
    for (var i = 0, len = files.length; i < len; i++) b.items.add(files[i]);
    return b.files;
}
function dropZone(data = []) {
    drop_zone.addEventListener("dragover", dragOverHandler);
    drop_zone.addEventListener("drop", dropHandler);
    data["paramName"] = "paramName" in data ? data["paramName"] : "drop_zone_input";
    data["multiple"] = "multiple" in data ? data["multiple"] : false;
    data["addDownloadinks"] = "addDownloadinks" in data ? data["addDownloadinks"] : true;
    data["addRemoveLinks"] = "addRemoveLinks" in data ? data["addRemoveLinks"] : true;
    data["addFileName"] = "addFileName" in data ? data["addFileName"] : true;
    data["addFileSize"] = "addFileSize" in data ? data["addFileSize"] : true;
    data["inputID"] = "inputID" in data ? data["inputID"] : "drop_zone_input";
    data["oldFilesPath"] = "oldFilesPath" in data && data["oldFilesPath"] != '' ? data["oldFilesPath"].split("||") : false;
    data["oldFilesID"] = "oldFilesID" in data && data["oldFilesID"] != '' ? data["oldFilesID"].split("||") : false;

    let input = document.createElement("input");
        input.setAttribute("type", "file");
        input.setAttribute("style", "display:none;");
        input.setAttribute("name", data["multiple"] ? data["paramName"] + "[]" : data["paramName"]);
        input.setAttribute("id", data["inputID"]);
        data["multiple"] ? input.setAttribute("multiple", "multiple") : "";
    drop_zone.prepend(input);
    drop_zone.addEventListener("click", (e) => {
        if (e.target.tagName.toLowerCase() != 'a' && e.target.tagName.toLowerCase() != 'span' && e.target.tagName.toLowerCase() != 'audio' && e.target.tagName.toLowerCase() != 'video') {
            input.click();
        }
    });
    input.onchange = function () {
        newestFiles = [];

        function pushFileWithValidations(i) {
            if ('acceptedFiles' in data) {
                var fileExtension = input.files[i].name.split('.')[input.files[i].name.split('.').length - 1];
                if ('maxFileSize' in data) {
                    if (input.files[i].size <= data['maxFileSize']) {
                        if (!Array.isArray(data['acceptedFiles'])) {
                            data['acceptedFiles'] = data['acceptedFiles'].split(',');
                        }
                        if (data['acceptedFiles'].includes(fileExtension)) {
                            fileStore.push(input.files[i]);
                            newestFiles.push(input.files[i]);
                        } else {
                            alert(`Sorry, but allowed extensions are [ ${data['acceptedFiles'].join(', ')} ]`)
                        }
                    } else {
                        alert(`Sorry, but max file size is ${formatBytes(data['maxFileSize'])}`);
                    }
                } else {
                    if (!Array.isArray(data['acceptedFiles'])) {
                        data['acceptedFiles'] = data['acceptedFiles'].split(',');
                    }
                    if (data['acceptedFiles'].includes(fileExtension)) {
                        fileStore.push(input.files[i]);
                        newestFiles.push(input.files[i]);
                    } else {
                        alert(`Sorry, but allowed extensions are [ ${data['acceptedFiles'].join(', ')} ]`)
                    }
                }
            } else {
                if ('maxFileSize' in data) {
                    if (input.files[i].size <= data['maxFileSize']) {
                        fileStore.push(input.files[i]);
                        newestFiles.push(input.files[i]);
                    } else {
                        alert(`Sorry, but max file size is ${formatBytes(data['maxFileSize'])}`);
                    }
                } else {
                    fileStore.push(input.files[i]);
                    newestFiles.push(input.files[i]);
                }
            }

        }
        if (data["multiple"]) {
            if ("maxFiles" in data) {
                if (input.files.length+drop_zone.querySelectorAll('div').length <= data['maxFiles']) {
                    for (var i = 0; i < input.files.length; i++) {
                        pushFileWithValidations(i);
                    }
                } else {
                    alert(`You can't upload more than ${data['maxFiles']} files`);
                }
            } else {
                for (var i = 0; i < input.files.length; i++) {
                    pushFileWithValidations(i);
                }
            }
        } else {
            if (input.files.length == 1 && drop_zone.querySelectorAll('div').length == 0) {
                pushFileWithValidations(0);
            } else {
                alert('You can\'t upload more than 1 file');
            }

        }
        drop_zone_input.files = new FileListItems(fileStore);
        'onUpload' in data ? data['onUpload'](newestFiles, drop_zone_input.files) : '';
        getImageUrlBase64(newestFiles);
    };

    if (data["oldFilesPath"]  && data['oldFilesID']) {
        for (let i = 0; i < data["oldFilesPath"].length; i++) {
            async function createFile(path = data["oldFilesPath"][i], fileID = data["oldFilesID"][i]) {
                var theFile = path.split("/")[path.split("/").length -1];
                let data = await fetch(path).then((response) =>
                    response.blob()
                );
                let metadata = {
                    type: data.type,
                };
                createdFile = new File([data], theFile, metadata);
                // fileStore.push(createdFile);
                getImageUrlBase64(createdFile, fileID);
            }
            createFile();
        }
    }

    function dropHandler(e) {
        e.preventDefault();
        function pushFileWithValidations(i) {
            if (e.dataTransfer.items[i].kind === "file") {
                var file = e.dataTransfer.items[i].getAsFile();
                var fileExtension = file.name.split('.')[file.name.split('.').length - 1];
                if ('acceptedFiles' in data) {
                    if ('maxFileSize' in data) {
                        if (file.size <= data['maxFileSize']) {
                            if (!Array.isArray(data['acceptedFiles'])) {
                                data['acceptedFiles'] = data['acceptedFiles'].split(',');
                            }
                            if (data['acceptedFiles'].includes(fileExtension)) {
                                fileStore.push(file);
                                newestFiles.push(file);
                            } else {
                                alert(`Sorry, but allowed extensions are [ ${data['acceptedFiles'].join(', ')} ]`);
                            }
                        } else {
                            alert(`Sorry, but max file size is ${formatBytes(data['maxFileSize'])}`);
                        }
                    } else {
                        if (!Array.isArray(data['acceptedFiles'])) {
                            data['acceptedFiles'] = data['acceptedFiles'].split(',');
                        }
                        if (data['acceptedFiles'].includes(fileExtension)) {
                            fileStore.push(file);
                            newestFiles.push(file);
                        } else {
                            alert(`Sorry, but allowed extensions are [ ${data['acceptedFiles'].join(', ')} ]`)
                        }
                    }
                } else {
                    if ('maxFileSize' in data) {
                        if (file.size <= data['maxFileSize']) {
                            fileStore.push(file);
                            newestFiles.push(file);
                        } else {
                            alert(`Sorry, but max file size is ${formatBytes(data['maxFileSize'])}`);
                        }
                    } else {
                        fileStore.push(file);
                        newestFiles.push(file);
                    }
                }
            }
        }
        if (e.dataTransfer.items) {
            newestFiles = [];
            if (data["multiple"]) {
                if ("maxFiles" in data) {
                    if (e.dataTransfer.items.length+drop_zone.querySelectorAll('div').length <= data['maxFiles']) {
                        for (var i = 0; i < e.dataTransfer.items.length; i++) {
                            pushFileWithValidations(i);
                        }
                    } else {
                        alert(`You can't upload more than ${data['maxFiles']} files`);
                    }
                } else {
                    for (var i = 0; i < e.dataTransfer.items.length; i++) {
                        pushFileWithValidations(i);
                    }
                }
            } else {
                if (e.dataTransfer.items.length == 1 && drop_zone.querySelectorAll('div').length == 0) {
                    pushFileWithValidations(0);
                } else {
                    alert('You can\'t upload more than 1 file');
                }
            }
        }
        drop_zone_input.files = new FileListItems(fileStore);
        'onUpload' in data ? data['onUpload'](newestFiles, drop_zone_input.files) : '';
        getImageUrlBase64(newestFiles);
    }
    function dragOverHandler(e) {
        e.preventDefault();
    }

    function getImageUrlBase64(files, fileID = false) {
        function buildUi(file, fileID = false) {
            let imagesExtensions = ['jpeg', 'jpg', 'png', 'gif', 'ico', 'icon', 'bmp', 'webp', 'psd', 'pdf', 'ai', 'raw', 'heif', 'indd', 'eps','jpe' ,'jif', 'jfif', 'jfi'],
                htmlExtensions = ['htm', 'html', 'xhtml', 'jhtml'],
                cssExtensions = ['css', 'scss', 'sass', 'less', 'ccss', 'pcss'],
                jsExtensions = ['js', 'jsx', 'vue'],
                phpExtensions = ['php', 'php4', 'php3', 'phtml'],
                codeExtensions = ['hss', 'asp', 'aspx', 'axd', 'asx', 'asmx', 'ashx', 'cfm', 'yaws', 'swf', 'jsp', 'jspx', 'wss', 'do', 'action', 'pl', 'py', 'rb', 'rhtml', 'shtml', 'xml', 'rss', 'svg', 'cgi', 'dll'],
                wordExtensions = ['doc', 'docm', 'docx', 'dot', 'dotm', 'dotx', 'mht', 'mhtml', 'pdf', 'rtf', 'odt', 'wps', 'txt', 'xml'],
                excelExtensions = ['csv', 'dbf', 'dif', 'ods', 'prn', 'slk', 'xla', 'xlam', 'xls', 'xlsb', 'xlsm', 'xlsx', 'xltm', 'xlt', 'xps'],
                powerPointExtensions = ['emf', 'pot', 'potm', 'potx', 'ppa', 'ppam', 'pps', 'ppsm', 'ppsx', 'ppt', 'pptm', 'pptx', 'thmx'],
                audioExtensions = ['mp3', 'aac', 'ogg', 'flac', 'alac', 'wav', 'aiff', 'dsd', 'pcm'],
                videoExtensions = ['webm', 'mkv', 'flv', 'vob', 'ogv', 'mng', 'avi', 'mov', 'wmv', 'qt', 'yuv', 'rm', 'rmvb', 'viv', 'asf', 'amv', 'mp4', 'm4p', 'm4v', 'mpg', 'mp2', 'mpeg', 'mpe', 'mpv', 'm2v', 'svi', '3gp', '3g2', 'mxf', 'roq', 'nsv', 'flv', 'f4v', 'f4p', 'f4a', 'f4b'],
                zipExtensions = ['zip', 'rar'];
            var fileExtension = file.name.split('.')[file.name.split('.').length - 1];


            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function () {
                productImageUrl = reader.result;
                let showFile= '', removeLink= '', downloadLink= '', fileSize= '', fileName= '';
                if (imagesExtensions.includes(fileExtension)) {
                    showFile = `<img src="${productImageUrl}" alt="${file.name}"/>`;
                } else if (zipExtensions.includes(fileExtension)) {
                    showFile = `<i class="far fa-file-archive fa-9x"></i>`;
                } else if (htmlExtensions.includes(fileExtension)) {
                    showFile = `<i class="fab fa-html5 fa-9x"></i>`;
                } else if (cssExtensions.includes(fileExtension)) {
                    showFile = `<i class="fab fa-css3 fa-9x"></i>`;
                } else if (jsExtensions.includes(fileExtension)) {
                    showFile = `<i class="fab fa-js-square fa-9x"></i>`;
                } else if (phpExtensions.includes(fileExtension)) {
                    showFile = `<i class="fab fa-php fa-9x"></i>`;
                } else if (codeExtensions.includes(fileExtension)) {
                    showFile = `<i class="fab fa-file-code fa-9x"></i>`;
                } else if (wordExtensions.includes(fileExtension)) {
                    showFile = `<i class="far fa-file-word fa-9x"></i>`;
                } else if (excelExtensions.includes(fileExtension)) {
                    showFile = `<i class="fas fa-file-excel fa-9x"></i>`;
                } else if (powerPointExtensions.includes(fileExtension)) {
                    showFile = `<i class="far fa-file-powerpoint fa-9x"></i>`;
                } else if (audioExtensions.includes(fileExtension)) {
                    showFile = `<audio src="${productImageUrl}" alt="${file.name}" style="height: 100%;width: 100%;z-index: 1;" controls></audio>`;
                } else if (videoExtensions.includes(fileExtension)) {
                    showFile = `<video src="${productImageUrl}" alt="${file.name}" style="height: 100%;object-fit: fill;z-index: 1;" controls></video>`;
                } else {
                    showFile = `<i class="fas fa-file fa-9x"></i>`;
                }
                var onDeleteFun = 'onDelete' in data ? data['onDelete'] : '';
                if (data["addDownloadinks"]) downloadLink = `<a download="myCustomDropZone" href="${productImageUrl}" style="right: auto;color:#52fdae;" title="Download"> &downarrow; </a>`;
                if (data["addRemoveLinks"]) removeLink = `<a onClick="deleteFile(this,${file.lastModified},${fileID},${onDeleteFun});" title="Delete"> &Cross; </a>`;
                if (data["addFileSize"]) fileSize = `<span style="top: 10%;">SIZE: ${formatBytes(file.size)}</span>`;
                if (data["addFileName"]) fileName = `<span>${file.name}</span>`;

                drop_zone.innerHTML += `
            <div>
                ${showFile}
                ${fileName}
                ${fileSize}
                ${removeLink}
                ${downloadLink}
            </div>
            `;
            };
            reader.onerror = function () {
                alert("Error!!");
            };
        }
        if (Array.isArray(files)) {
            files.forEach((file) => {
                buildUi(file);
            });
        } else {
            buildUi(files, fileID);
        }
    }

    if ('submitButtons' in data) {
        let submitBtns = data['submitButtons'].split(','), submitBtn;
        submitBtns.forEach(btn => {
            submitBtn = document.querySelector(btn);
            if (submitBtn) {
                submitBtn.setAttribute('onclick', `drop_zone_input.files = new FileListItems(fileStore);${submitBtn.getAttribute('onclick') != null ? submitBtn.getAttribute('onclick') : ''}`)
            } else {
                alert(`sorry but this submitButton ${btn} you set in Drop Zone isn't exist`)
            }
        })
    }

}
