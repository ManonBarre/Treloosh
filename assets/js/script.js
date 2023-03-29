/**
 * ADD TASKS
 */
(function () {
  window.onload = function () {
    /**
     * Cree un element du dom , lui ajoute du texte et le place comme dernier enfant de parent et ajoute un attribut avec "attribute"
     * @param {string} markup_name 
     * @param {String} text 
     * @param {domElement} parent 
     * @param {object} attribute  doit comprendre les proprietés name et value
     * @returns domElement 
     */

    function createMarkup(markup_name, text, parent, attribute, attribute2) {
      const markup = document.createElement(markup_name);
      markup.textContent = text;
      parent.appendChild(markup);
      if (attribute && attribute.hasOwnProperty("name")) {
        markup.setAttribute(attribute.name, attribute.value);
      }
      if (attribute2 && attribute2.hasOwnProperty("name")) {
        markup.setAttribute(attribute2.name, attribute2.value);
      }
      return markup;
    }

    const btn = document.getElementById('btn-task');
    btn.onclick = function () {
      let task = createMarkup("div", document.getElementById('task-text').value, document.getElementById('addItem'), { name: "class", value: "list-item" }, { name: "draggable", value: "true" });

      /**
       * MODAL BOX
       */
      var openModal = document.querySelectorAll(".list-item");

      openModal.forEach(element => {
        element.addEventListener("click", showModal)
      });

      /**
     * DRAG & DROP
     */
      const list_items = document.querySelectorAll(".list-item"); // Item déplacable
      const lists = document.querySelectorAll(".list"); // Liste d'élément

      let draggedItem = null;

      for (let i = 0; i < list_items.length; i++) {
        const item = list_items[i];

        item.addEventListener("dragstart", function () {
          draggedItem = item;
          setTimeout(function () {
            item.style.display = "none";
          }, 0);
        });

        item.addEventListener("dragend", function () {
          setTimeout(function () {
            draggedItem.style.display = "block";
            draggedItem = null;
          }, 0);
        });

        for (let j = 0; j < lists.length; j++) {
          const list = lists[j];

          list.addEventListener("dragover", function (e) {
            e.preventDefault();
          });

          list.addEventListener("dragenter", function (e) {
            e.preventDefault();
            this.style.backgroundColor = "#D8843B";
          });

          list.addEventListener("dragleave", function (e) {
            this.style.backgroundColor = "#F1D6A1";
          });

          list.addEventListener("drop", function (e) {
            console.log("drop");
            this.append(draggedItem);
            this.style.backgroundColor = "#F1D6A1";
          });
        }

      }
    }

    var modal = document.getElementById("modalBox");
    // Modal apears
    function showModal() {
      modal.style.display = "block";
    }
    

    // On click on <span> close the modal
    var span = document.getElementsByClassName("close")[0];
    span.onclick = function () {
      modal.style.display = "none";
    }

    // On click anywhere close modal box
    window.onclick = function (event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  }
})();
