# candology

Title: Candology
Description: Ecommerce website to buy candles and diffusers. Has built in functionality to manage inventory and orders by an admin.
Authors: Zahra, Caleb, Patrick

Admin username: admin
Admin password: @dm1n

1. Database and validation is in the model folder, all html files are in the views folder, index.php contains routes for all html files, index.php uses a controller to return views a long with call datalayer functions, Classes are in the classes folder, all Javascript/Ajax are in the scripts folder
2. Fat Free is used, all routes render a template view page.
3. DataLayer is in the model folder, using PDO and prepared statements to query our database.
4. Accounts and Orders can be created. Orders and Products can be viewed by admin.
5. Everyone has commits in the repo.
6. Uses multiple classes, with a Candle and Diffuser class inheriting from a parent Product class. These classe are located in the classes folder
7. To DO: Check for doc blocks and comments
8. Create account form has full validation in Javascript and PHP.
9. To Do: Check code is clean and well-commented
10. We learned some new bootstrap features, learned and implemented some more complicated SQL queries than our other projects. We got the minimum amount of features we wanted complete.
11. Using Ajax for an admin feature, display-button-on-focus in the scripts folder .loads a route that calls a PHP script to update database with POST data passed from the javascript script.


Class UML Diagram:

[![](https://mermaid.ink/img/pako:eNqFlVFPwjAQx7_K0vgACb74uPiCgomJEgxIollialugceuW9mZE9Lt729oxuoLwsv7-t7vrv1fYE5ZzQWLCUmrMRNKNplmiIvzUJJrrnJcMEtVAu4ziSCqILt6KZn3PfdmAlmpziJjRTPwXMxGGaVmAzM9Xe1q-nEklmeh3uxEwd60OhqfVqs1zeqfFc2HY4QkZuxsMEVctHgdc_1xeRrdU8bTtv1nhqxdv76VWIJ2HrYA5b1CpigXzTeR6XRqhnejWdU7DhIIex5SLSnAb6EimI3WH5LlT4dllX6v2yFuWBliV281PC0VGZeoxPGMhwIOUcy2MufIwk7Dz0Lcsegkp-N0wqvmszAJ0-lU85gq2YelFUO0rn5-eKWjtXXfCDvghjBtv-nxa2dPHi9qhPh9bk_rKLfrUp6-yCCVHtwIZGsPCgvPspFrZFhBXq-5EN0M25plsUb2wA4BPbn4O2A7QMa6tqMNdTV9pjT2ujd3C4VJqcCfvQ5xGe_1cASs0Ow7QZQ40PYFtKuPJ0kyzojm24y8ZkUxo3AHHH_R99U5CYCvwxpEYHznVHwlJ1C_GlQXH05xyCbkm8ZqmRowILSFf7BQjMehSuCD7p2Cjfv8AKOP4YA)](https://mermaid-js.github.io/mermaid-live-editor/edit#pako:eNqFlVFPwjAQx7_K0vgACb74uPiCgomJEgxIollialugceuW9mZE9Lt729oxuoLwsv7-t7vrv1fYE5ZzQWLCUmrMRNKNplmiIvzUJJrrnJcMEtVAu4ziSCqILt6KZn3PfdmAlmpziJjRTPwXMxGGaVmAzM9Xe1q-nEklmeh3uxEwd60OhqfVqs1zeqfFc2HY4QkZuxsMEVctHgdc_1xeRrdU8bTtv1nhqxdv76VWIJ2HrYA5b1CpigXzTeR6XRqhnejWdU7DhIIex5SLSnAb6EimI3WH5LlT4dllX6v2yFuWBliV281PC0VGZeoxPGMhwIOUcy2MufIwk7Dz0Lcsegkp-N0wqvmszAJ0-lU85gq2YelFUO0rn5-eKWjtXXfCDvghjBtv-nxa2dPHi9qhPh9bk_rKLfrUp6-yCCVHtwIZGsPCgvPspFrZFhBXq-5EN0M25plsUb2wA4BPbn4O2A7QMa6tqMNdTV9pjT2ujd3C4VJqcCfvQ5xGe_1cASs0Ow7QZQ40PYFtKuPJ0kyzojm24y8ZkUxo3AHHH_R99U5CYCvwxpEYHznVHwlJ1C_GlQXH05xyCbkm8ZqmRowILSFf7BQjMehSuCD7p2Cjfv8AKOP4YA)
