/**
 * BLOCK: Client Reviews
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
import "./editor.scss";
import "./style.scss";

const { __ } = wp.i18n; // Import __() from wp.i18n
const { registerBlockType } = wp.blocks; // Import registerBlockType() from wp.blocks
// import {
// 	Flex,
// 	Card,
// 	FlexBlock,
// 	CardBody,
// 	TextareaControl,
// 	TextControl,
// } from "@wordpress/components";

registerBlockType("cgb/block-client-reviews", {
	// Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
	title: __("Client Reviews"), // Block title.
	icon: "text-page", // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
	category: "common", // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
	keywords: [
		__("my-blocks — CGB Block"),
		__("CGB Example"),
		__("create-guten-block"),
	],

	attributes: {},
	edit: ({ attributes, setAttributes }) => {
		return "Здесь будут отзывы пользователей";
	},

	save: (props) => {
		return null;
	},
});
