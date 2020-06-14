
# CSS Duplicate Styles Remover

Input two CSS files and then output a single override stylesheet

# Example

**Default stylesheet**

    .style-1, .style-2, .style-3 {  
      color: #007bff;  
      font-size: 1.2em;  
      font-weight: bold;  
    }  
      
    .style-3, .style-4 {  
      background-color: #dc3545;  
    }  
      
    .style-5 {  
      font-size: 1rem;  
      font-weight: 400;  
      line-height: 1.5;  
    }  
      
    .style-6, .style-7{  
        text-decoration: underline dotted;  
      cursor: help;  
      border-bottom: 0;  
      text-decoration-skip-ink: none;  
    }

**Override stylesheet**

    .style-1, .style-2, .style-3 {  
      color: #007bff;  
      font-size: 1.2em;  
      font-weight: bold;  
    }  
      
    .style-3, .style-4 {  
      background-color: #c6c6c6;  
    }  
      
    .style-5 {  
      font-size: 1rem;  
      font-weight: 400;  
      line-height: 1.5;  
      color: orange;  
    }  
      
    .style-6, .style-7{  
      text-decoration: underline dotted;  
      cursor: help;  
      border-bottom: 5px;  
      text-decoration-skip-ink: none;  
    }

**Output**

    .style-3, .style-4 {  
      background-color: #c6c6c6;  
    }  
    .style-5 {  
      color: orange;  
    }  
    .style-6, .style-7 {  
      border-bottom: 5px;  
    }

## Simple Setup

 1. `git clone git@github.com:harryspink/css-override-creator.git`
 2. `cd css-override-creator`
 3. Install composer libraries `composer install`

## Simple Setup

Usage - it takes three input options

 1. main css file path
 2. override css file path
 3. output css file path

### Example

    php parse.php css/main.css css/override.css css/output.css


