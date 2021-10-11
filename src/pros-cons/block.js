/**
 * BLOCK: Pros & Cons
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
import "./editor.scss";
import "./style.scss";

const { __ } = wp.i18n; // Import __() from wp.i18n
const { registerBlockType } = wp.blocks; // Import registerBlockType() from wp.blocks
import {
	Flex,
	Card,
	FlexBlock,
	CardBody,
	TextareaControl,
} from "@wordpress/components";

/**
 * Register: aa Gutenberg Block.
 *
 * Registers a new block provided a unique name and an object defining its
 * behavior. Once registered, the block is made editor as an option to any
 * editor interface where blocks are implemented.
 *
 * @link https://wordpress.org/gutenberg/handbook/block-api/
 * @param  {string}   name     Block name.
 * @param  {Object}   settings Block settings.
 * @return {?WPBlock}          The block, if it has been successfully
 *                             registered; otherwise `undefined`.
 */
registerBlockType("cgb/block-pros-cons", {
	// Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
	title: __("Pros & Cons"), // Block title.
	icon: "text-page", // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
	category: "common", // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
	keywords: [
		__("my-blocks — CGB Block"),
		__("CGB Example"),
		__("create-guten-block"),
	],

	attributes: {
		pros: {
			type: "array",
			default: ["Достоинство"],
		},
		cons: {
			type: "array",
			default: ["Недостаток"],
		},
	},
	edit: ({ attributes, setAttributes }) => {
		function setPostData(value, field) {
			const featuresArray = value.split("\n");
			if (field === "pros") {
				setAttributes({
					pros: featuresArray,
				});
			} else {
				setAttributes({
					cons: featuresArray,
				});
			}
		}
		return (
			<Flex>
				<FlexBlock>
					<Card>
						<CardBody>
							<TextareaControl
								label="Достоинства"
								value={attributes.pros.join("\n")}
								onChange={(value) => setPostData(value, "pros")}
							/>
						</CardBody>
					</Card>
				</FlexBlock>
				<FlexBlock>
					<Card>
						<CardBody>
							<TextareaControl
								label="Недостатки"
								value={attributes.cons.join("\n")}
								onChange={(value) => setPostData(value, "cons")}
							/>
						</CardBody>
					</Card>
				</FlexBlock>
			</Flex>
		);
	},

	save: (props) => {
		return null;
	},
});
