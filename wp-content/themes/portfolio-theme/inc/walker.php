<?php 

/*
@package portfolio-theme

	==================================================
		WALKER NAV CLASS
	==================================================

*/

//Walker Class written with php4

/*
	when we call function wp_nav_menu() wordpress generates:

	<div class="menu-container">
		<ul>//start_lvl() - function name of walker class that manages the ul.
			<li><a>Link</a><span>Description</span></li> //All the li, a, span elements are start_el().


			<li><a><span>//start_el() - is responsible just for the start elements
				
				<ul> //if inside li element put ul element and we whant to apply elements a class of dropdown menu instead of the submenu class that wordpress automatically applies, because i dont need a submenu class i need a dropdown menu class that is the default at bootstrap class. So there is a need to detect where is a new level of submenu appiers and it starts and when the new class is generated. To do that in start_lvl() use a variable $submenu....
				</span></a></li>//end_el() - to customize the closing elements


			<li><a>Link</a></li>
			<li><a>Link</a></li>
		</ul>// end_lvl() - to close the ul ending element.
	</div>

Walker class gives the ability to access all the elements and customize the markup that is generated
*/

class Portfolio_Walker_Nav_primary extends Walker_Nav_menu {

	function start_lvl( &$output, $depth ){//handle ul.
		//placed value of &$output with ampersend, because we dont whant to rewrite the complete information what WordPress generates. If there will not be &before $output the variable will be EMPTY.
		//First Variable - output, Second Variable - depth, Third Variable - arguments.

		//define variables
		$indent = str_repeat("\t", $depth);//  \t - create a space tab into html code to organize the same structure. $depth variable - automatically recognizes and grabs how many level of indentation i have in my menu.

		$submenu = ($depth > 0) ? 'sub-menu' : '';//tutorial in 24 row.
		//if depth > 0 than we are in a level of indentation(ispjova).
		//sub-menu - default class of WordPress

		$output .= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\">\n"; // . - merges two elements. // \n$indent - here we are printing \t from $indet and \t is adding spaces. 
		//dropdown-menu$submenu - adding to submenu element the dropdown-menu (adding to the markup a custom class)
		//depth_$depth - plus specifying the amount of depth. In wich level we are.
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ){//handle li, a, span. $depth = 0 - zero to prevent any errors. Fourth variable - the arguments variable $args = array(), it is an array that contains all of our items.
		$indent = ($depth) ? str_repeat("\t", $depth) : ''; //if $depth is defined ? and str_repeat() is true : otherwise an indent will be empty.

		//define empty variables with specific empty values to populate with custom html markup. So need to create two variables.
		$li_attributes = '';
		$class_names = $value = '';

		//check the classes of item
		$classes = empty( $item->classes ) ? array() : (array) $item->classes; //classes -  come from the custom classes that are specified inside administration panel -> menu section.

		//adding to an array of $classes variable without adding attaching to a string or without rewriting an array using this format.
		$classes[] = ($args->walker->has_children) ? 'dropdown' : '';//walker - sublevel //has_children - is an attribute that is predefined by wordpress. If has_children value is true than the item here has a children (for example: <ul>).
		$classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : ''; //$item->current_item_ancestor - if the item has the class of the prebuild WordPress function. Checking if the link in the submenu of that item is clicked.//MISTAKE - not current_item_anchestor, but current_item_ancestor.
		$classes[] = 'menu-item-' . $item->ID;//add a class that by default comes with wordpress and it is the menu item conected to the id.
		//$item->ID  -  access the ID element inside of the $item array.

		//check all the possible outcome and all the possible editing that user in admin pannel could apply to prevent error.
		if( $depth && $args->walker->has_children ){
			$classes[] = 'dropdown-submenu';
		}

		//merge all the arrays that is created
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter($classes), $item, $args ) );//join() - merges some specific arrays. apply_filter() - filter is tha nav menu css class will edit all the classes that is specified above in a proper way that WordPress needs. If the filter will not be applied WordPress will create a lot of errors.
		//array_filter() - function loops throught all the elements that are inside the specific array that are specified and applies this filter the first value to all the single elements.
		$class_names = ' class="' . esc_attr($class_names) . '" ';
		$id = apply_filters('nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args);
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ). '" ': '';

		$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

		//Variables that has to contain all the attributes of the <li> tag.
		$attributes = !empty( $item->attr_title ) ? ' title="' . esc_attr($item->attr_title) . '" ' : '';
		$attributes .= !empty( $item->target ) ? ' target="' . esc_attr($item->target) . '" ' : '';
		$attributes .= !empty( $item->xfn ) ? ' rel="' . esc_attr($item->xfn) . '" ' : '';//xfn - contains the rel statement. It is the same.
		$attributes .= !empty( $item->url ) ? ' href="' . esc_attr($item->url) . '" ' : '';

		$attributes .= ( $args->walker->has_children ) ? 'class="dropdown-toggle" data-toggle="dropdown"' : '';

		$item_output = $args->before; //before - WordPress generate by default.
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= ( $depth = 0 && $args->walker->has_children ) ? ' <b class="caret"></b></a>' : '</a>';
		$item_output .= $args->after; //after - WordPress generate by default.

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
/*
	function end_el(){// closing li a span tags
		
	}

	function end_lvl(){//closing of ul markup
		
	}
*/
}

?>